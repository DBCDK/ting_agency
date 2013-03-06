<?php

class TingClientAgencyBranch {

  public $branchId;
  public $branchName;
  public $branchPhone;
  public $branchEmail;
  public $postalAddress;
  public $postalCode;
  public $city;
  public $branchWebsiteUrl;
  public $serviceDeclarationUrl;
  public $openingHours;
  public $temporarilyClosed;
  public $illOrderReceiptText;
  public $userStatusUrl;
  public $pickupAllowed;
  public $agencyName;
  private static $fields;

  public function __construct($pickupAgency, $agencyId = NULL) {
    if (isset($agencyId)) {
      $this->branchId = $agencyId;
    }
    elseif (!empty($pickupAgency)) {
      $this->pickupAgency = $pickupAgency;
      $this->set_attributes($pickupAgency);
    }
    else {
      throw new TingClientAgencyBranchException('TingClientAgencyBranch constructor needs either agencyid or findlibraryresponse (openagency.addi.dk)');
      // do something .. throw an exception
    }
  }

  private function set_attributes($pickupAgency) {
    $this->branchId = TingClientRequest::getValue($pickupAgency->branchId);
    $this->branchName = TingClientRequest::getValue($pickupAgency->branchName);
    $this->branchPhone = TingClientRequest::getValue($pickupAgency->branchPhone);
    $this->branchEmail = TingClientRequest::getValue($pickupAgency->branchEmail);
    if (isset($pickupAgency->postalAddress)) {
      $this->postalAddress = TingClientRequest::getValue($pickupAgency->postalAddress);
    }
    if (isset($pickupAgency->postalCode)) {
      $this->postalCode = TingClientRequest::getValue($pickupAgency->postalCode);
    }
    if (isset($pickupAgency->city)) {
      $this->city = TingClientRequest::getValue($pickupAgency->city);
    }
    if (isset($pickupAgency->branchWebsiteUrl)) {
      $this->branchWebsiteUrl = TingClientRequest::getValue($pickupAgency->branchWebsiteUrl);
    }
    if (isset($pickupAgency->serviceDeclarationUrl)) {
      $this->serviceDeclarationUrl = TingClientRequest::getValue($pickupAgency->serviceDeclarationUrl);
    }
    if (isset($pickupAgency->openingHours)) {
      $this->openingHours = $pickupAgency->openingHours;
    }
    if (isset($pickupAgency->temporarilyClosed)) {
      $this->temporarilyClosed = TingClientRequest::getValue($pickupAgency->temporarilyClosed);
    }
    if (isset($pickupAgency->illOrderReceiptText)) {
      $this->illOrderReceiptText = $pickupAgency->illOrderReceiptText;
    }
    if (isset($pickupAgency->userStatusUrl)) {
      $this->userStatusUrl = TingClientRequest::getValue($pickupAgency->userStatusUrl);
    }
    if (isset($pickupAgency->pickupAllowed)) {
      $this->pickupAllowed = TingClientRequest::getValue($pickupAgency->pickupAllowed);
    }
    if( isset($pickupAgency->agencyName) ) {
      $this->agencyName = TingClientRequest::getValue($pickupAgency->agencyName);
    }
  }

  // @TODO move this function to ting_agency/TingClientAgencyBranch
  public function getOpeningHours($lang) {
    // drupal en = openformat eng
    if ($lang == 'en' || $lang == 'en-gb') {
      $lang = 'eng';
    }
    //drupal da = openformat dan
    if ($lang == 'da') {
      $lang = 'dan';
    }

    $hours = isset($this->openingHours) ? $this->openingHours : 'FALSE';
    if (is_array($hours)) {
      foreach ($hours as $open) {
        if ($open->{'@language'}->{'$'} == $lang) {
          $ret = $open->{'$'};
        }
      }
      if (empty($ret)) {
        // given lanuguage was not found..simply return first in array
        $ret = $hours[0]->{'$'};
      }
    }
    else {
      // opening hours are not set
      $ret = t('ting_agency_no_opening_hours');
    }
    return $ret;
  }

  public function getActionLinks() {
    $links = array();
    if (isset($this->serviceDeclarationUrl)) {
      $links[t('serviceDeclarationUrl')] = $this->serviceDeclarationUrl;
    }
    if (isset($this->branchWebsiteUrl)) {
      $links[t('branchWebsiteUrl')] = $this->branchWebsiteUrl;
    }

    // @TODO .. any more links ??

    return $links;
  }

  public function getAddress() {
    $address = '';
    if (isset($this->postalAddress)) {
      $address .= $this->postalAddress . '<br/>';
    }
    if (isset($this->postalCode)) {
      $address .= $this->postalCode;
    }
    if (isset($this->city)) {
      $address .= ' ' . $this->city;
    }
    $address .= '<br/>';

    return $address;
  }

  public function getContact() {
    $ret = array();
    if (isset($this->branchPhone)) {
      $ret[t('branchPhone')] = $this->branchPhone;
    }
    if (isset($this->branchEmail)) {
      $ret[t('branchEmail')] = $this->branchEmail;
    }

    return $ret;
  }

  public function getIllOrderReceiptText($lang='da') {
    // drupal en = openformat eng
    if ($lang == 'en' || $lang == 'en-gb') {
      $lang = 'eng';
    }
    //drupal da = openformat dan
    if ($lang == 'da') {
      $lang = 'dan';
    }

    $illOrderReceiptText = isset($this->illOrderReceiptText) ? $this->illOrderReceiptText : 'FALSE';

    if (is_array($illOrderReceiptText)) {
      foreach ($illOrderReceiptText as $text) {
        if ($text->{'@language'}->{'$'} == $lang) {
          $ret = $text->{'$'};
        }
      }
      if (empty($ret)) {
        // given lanuguage was not found..simply return first in array
        $ret = $text->{'$'};
      }
    }
    else {
      // illOrderReceiptText are not set
      $ret = t('ting_agency_no_order_receipt_text');
    }
    return $ret;
  }


  /*
   * return AgencyFields
   */

 /* public function getAgencyFields() {
    if (!isset(self::$fields)) {
      $response = $this->_execute_agency($this->branchId, 'serviceRequest', 'userOrderParameters');
      $service = 'userOrderParameters';

      if (isset($response->serviceResponse)) {
        $response = $response->serviceResponse;
        if (isset($response->$service)) {
          $result = $response->$service;
        }
        else if (isset($response->error) && $response->error) {
          $result['error'] = TingClientRequest::getValue($response->error);
          return NULL;
        }
      }
      self::$fields = new AgencyFields($result);
    }
    return self::$fields;
  } */

  private function _execute_agency($agencyId, $action, $service = NULL) {
    $client = new ting_client_class();
    $response = $client->do_agency(array('agencyId' => $agencyId, 'action' => $action, 'service' => $service));
    return $response;
  }
}
