<?php

/**
 * class holding an agency
 */
class TingAgency {

  private $agencyId;
  private $error;
  private $branch;
  private $information;
  private $pickUpAgencies;
  private $pickUpAllowed;
  private static $fields;

  public function __construct($agencyId) {
    $this->agencyId = $agencyId;
  }

  public function getAgencyId() {
    return $this->agencyId;
  }

  public function getAgencyMainId() {
    $branch = $this->getBranch();
    if(!empty($branch)){
      return $this->getBranch()->agencyId;
    }
    return $this->getAgencyId();
  }

  public function getError() {
    return $this->error;
  }

  public function setBranch($branch) {
    $this->branch = $branch;
  }

  public function getBranch($include_hidden = FALSE) {
    if (empty($this->branch)) {
      $response = $this->do_FindLibraryRequest($include_hidden);
      if ($this->check_response($response)) {
        if (isset($response->findLibraryResponse->pickupAgency[0])) {
          $this->branch = new TingClientAgencyBranch($response->findLibraryResponse->pickupAgency[0]);
        }
      }
      else {
        $this->branch = FALSE;
      }
    }
    return $this->branch;
  }

  /* @deprecated Use getBranch() instead */
  public function getInformation() {
    if (empty($this->information)) {
      $response = $this->do_serviceRequest('information');
      if ($this->check_response($response)) {
        if (isset($response->serviceResponse->information)) {
          $this->information = new TingClientAgencyInformation($response->serviceResponse->information);
        }
      }
      else {
        $this->information = FALSE;
      }
    }
    return $this->information;
  }

  /**
   * @param mixed $pickUpAgencies
   */
  public function setPickUpAgencies($pickUpAgencies) {
    $this->pickUpAgencies = $pickUpAgencies;
  }

  /**
   * @return mixed
   */
  public function getPickUpAgencies() {
    if (!isset($this->pickUpAgencies)) {
      $response = $this->do_pickupAgencyListRequest();
      $pickUpAgencies = array();
      if ($this->check_response($response)) {
        if (isset($response->pickupAgencyListResponse->library[0]->pickupAgency)) {
          foreach ($response->pickupAgencyListResponse->library[0]->pickupAgency as $pickUpAgency) {
            $pickUpAgencies[] = new TingClientAgencyBranch($pickUpAgency);
          }
        }
      }
      $this->setPickUpAgencies($pickUpAgencies);
    }
    return $this->pickUpAgencies;
  }

  /** get pickupagencies in the form [branchID => branchShortName]   *
   *
   * @global type $language
   * @return array; empty if no pickupAgencies
   */
  public function getPickupAgencySelectList() {
    global $language;
    $pickUpAgencies = $this->getPickUpAgencies();
    $arr = array();
    if ($pickUpAgencies) {
      foreach ($pickUpAgencies as $branch) {
        $name = $branch->getBranchName($language->language);
        if ($branch->getBranchType() == 'b') {
          $arr += $this->getPickupAgencySubdivsionSelectElement($branch);
        }
        else {
          $arr[$branch->branchId] = $branch->getBranchShortName($language->language);
        }
      }
    }

    return $arr;
  }

  public function hasSubDivisions($branchId) {
    $pickUpAgencies = $this->getPickUpAgencies();
    if ($pickUpAgencies) {
      foreach ($pickUpAgencies as $branch) {
        if ($branch->branchId == $branchId) {
          if (isset($branch->pickupAgency->agencySubdivision)) {
            return TRUE;
          }
        }
      }
    }
    return FALSE;
  }

  /** get pickupAgencySubdivision (bus stops)
   *
   * @return array ['bogbussen'][branchId => name]
   */
  private function getPickupAgencySubdivsionSelectElement($branch) {
    $arr = array();
    if (isset($branch->pickupAgency->agencySubdivision)) {
      $subdivisions = $branch->getAgencySubdivisions();
      foreach ($subdivisions as $key => $value) {
        // $arr['Bogbussen:'][$branch->branchId . '-' . $value] = $value;
        $arr['Bogbussen:'][$value] = $value;
      }
    }
    return $arr;
  }

  public function getUpdateOrderAllowed() {
    $branch = $this->getBranch();
    if (isset($branch)) {
      return $branch->getNcipUpdateOrder();
    }
  }

  public function getRenewOrderAllowed() {
    $branch = $this->getBranch();
    if (isset($branch)) {
      return $branch->getNcipRenewOrder();
    }
  }

  /**
   * @param mixed Sets pickUpAllowed to TRUE or FALSE
   */
  public function setPickUpAllowed($pickUpAllowed) {
    $this->$pickUpAllowed = $pickUpAllowed;
  }

  /**
   * @return TRUE if pickupAllowed  else FALSE
   */
  public function getPickUpAllowed() {
    if (empty($this->pickUpAllowed)) {
      $response = $this->do_FindLibraryRequest();
      if ($this->check_response($response)) {
        if (isset($response->findLibraryResponse->pickUpAllowed[0])) {
          $this->pickUpAllowed = new TingClientAgencyBranch($response->findLibraryResponse->pickUpAllowed[0]);
        }
      }
      else {
        $this->pickUpAllowed = FALSE;
      }
    }
    return $this->pickUpAllowed;
  }

  public function getAgencyFields() {
    $service = 'userOrderParameters';
    $response = $this->do_serviceRequest($service);
    return self::$fields = ($this->check_response($response)) ?
      new AgencyFields($response->serviceResponse->$service) :
      NULL;
  }

  private function do_FindLibraryRequest($include_hidden = FALSE) {
    $client = new ting_client_class();
    $params = array(
      'agencyId' => $this->agencyId,
      'action' => 'findLibraryRequest',
      'outputType' => 'json'
    );
    if ($include_hidden) {
      $params['libraryStatus'] = 'aktive';
    }
    $response = $client->do_request('AgencyRequest',$params);
    return $response;
  }

  private function do_serviceRequest($service) {
    $client = new ting_client_class();
    $response = $client->do_request('AgencyRequest', array(
      'agencyId' => $this->agencyId,
      'action' => 'serviceRequest',
      'service' => $service,
      'outputType' => 'json'
    ));
    return $response;
  }

  private function do_pickupAgencyListRequest($include_hidden = FALSE) {
    $client = new ting_client_class();
    $params = array(
      'agencyId' => $this->agencyId,
      'pickupAllowed' => '1',
      'action' => 'pickupAgencyListRequest',
      'outputType' => 'json'
    );
    if ($include_hidden) {
      $params['libraryStatus'] = 'aktive';
    }
    $response = $client->do_request('AgencyRequest',$params);
    return $response;
  }

  private function check_response($response) {
    if (!$response || !is_object($response)) {
      return FALSE;
    }
    if (isset($response->error) && $response->error) {
      $this->error = TingClientRequest::getValue($response->error);
      return FALSE;
    }
    return TRUE;
  }

}
