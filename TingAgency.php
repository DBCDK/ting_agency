<?php

/**
 * class holding an agency
 */
class TingAgency {

  private $agencyId;
  private $error;
  private $branch;
  private $information;
  private static $fields;

  public function __construct($agencyId) {
    $this->agencyId = $agencyId;
  }

  public function getAgencyId() {
    return $this->agencyId;
  }

  public function getError() {
    return $this->error;
  }

  public function setBranch($branch) {
    $this->branch = $branch;
  }

  public function getBranch() {
    if (empty($this->branch)) {
      $response = $this->do_FindLibraryRequest();
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

  public function getAgencyFields() {
    $service = 'userOrderParameters';
    $response = $this->do_serviceRequest($service);
    if ($this->check_response($response)) {
      self::$fields = new AgencyFields($response->serviceResponse->$service);
    }
    else {
      // do something
      self::$fields = NULL;
    }
    return self::$fields;
  }

  private function do_FindLibraryRequest() {
    $client = new ting_client_class();
    $response = $client->do_agency(array('agencyId' => $this->agencyId, 'action' => 'findLibraryRequest'));
    return $response;
  }

  private function do_serviceRequest($service) {
    $client = new ting_client_class();
    $response = $client->do_agency(array('agencyId' => $this->agencyId, 'action' => 'serviceRequest', 'service' => $service));
    return $response;
  }

  private function check_response($response) {
    if (isset($response->error) && $response->error) {
      $this->error = TingClientRequest::getValue($response->error);
      return FALSE;
    }
    return TRUE;
  }

}

?>
