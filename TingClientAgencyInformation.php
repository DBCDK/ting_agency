<?php

class TingClientAgencyInformation {

  private static $fields;

  public function __construct($information) {
    if (!empty($information)) {
      $this->information = $information;
    }
    else {
      throw new TingClientAgencyBranchException('TingClientAgencyInformation constructor needs either agencyid or findlibraryresponse (openagency.addi.dk)');
      // do something .. throw an exception
    }
  }

  public function getAgencyId() {
    return isset($this->information->agencyId->{'$'}) ? $this->information->agencyId->{'$'} : NULL;
  }

  public function getAgencyName() {
    return isset($this->information->agencyName->{'$'}) ? $this->information->agencyName->{'$'} : NULL;
  }

  public function getBranchEmail() {
    return isset($this->information->branchEmail->{'$'}) ? $this->information->branchEmail->{'$'} : NULL;
  }

  public function getBranchId() {
    return isset($this->information->branchId->{'$'}) ? $this->information->branchId->{'$'} : NULL;
  }

  public function getBranchName() {
    return isset($this->information->branchName->{'$'}) ? $this->information->branchName->{'$'} : NULL;
  }

  public function getBranchPhone() {
    return isset($this->information->branchPhone->{'$'}) ? $this->information->branchPhone->{'$'} : NULL;
  }

  public function getCity() {
    return isset($this->information->city->{'$'}) ? $this->information->city->{'$'} : NULL;
  }

  public function getLookupUrl() {
    return isset($this->information->lookupUrl->{'$'}) ? $this->information->lookupUrl->{'$'} : NULL;
  }

  public function getPostalAddress() {
    return isset($this->information->postalAddress->{'$'}) ? $this->information->postalAddress->{'$'} : NULL;
  }

  public function getPostalCode() {
    return isset($this->information->postalCode->{'$'}) ? $this->information->postalCode->{'$'} : NULL;
  }

  public function getPickupAllowed() {
    return isset($this->information->agencyName->{'$'}) ? $this->information->pickupAllowed->{'$'} : NULL;
  }

  public function getRequestOrder(){
    return isset($this->information->requestOrder->{'$'}) ? $this->information->requestOrder->{'$'} : NULL;
  }

  public function getAddress() {
    $address = '';
    if ($this->getPostalAddress()) {
      $address .= $this->getPostalAddress() . '<br/>';
    }
    if ($this->getPostalCode()) {
      $address .= $this->getPostalCode();
    }
    if ($this->getCity()) {
      $address .= ' ' . $this->getCity();
    }
    $address .= '<br/>';

    return $address;
  }
}
