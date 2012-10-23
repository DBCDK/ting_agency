<?php
class AgencyRequest extends TingClientRequest{
  // attributes for findlibrary request 
  protected $action;
  protected $authentication;
  protected $agencyId;
  protected $agencyName;
  protected $agencyAddress;
  protected $postalCode;
  protected $city;
  protected $anyField;
  protected $libraryType;
  protected $libraryStatus;
  protected $pickupAllowed;
  protected $sort;
  protected $callback;
  protected $outputType; 
  
  protected $service;
  
  public function getService() {
    return $this->service;
  }
  
  public function setService($value) {
    $this->service = $value;
  }
  
  public function getAction() {
    return $this->action;
  }

  public function setAction($action) {
    $this->action = $action;
  }

  public function getAuthentication() {
    return $this->authentication;
  }

  public function setAuthentication($authentication) {
    $this->authentication = $authentication;
  }

  public function getAgencyId() {
    return $this->agencyId;
  }

  public function setAgencyId($agencyId) {
    $this->agencyId = $agencyId;
  }

  public function getAgencyName() {
    return $this->agencyName;
  }

  public function setAgencyName($agencyName) {
    $this->agencyName = $agencyName;
  }

  public function getAgencyAddress() {
    return $this->agencyAddress;
  }

  public function setAgencyAddress($agencyAddress) {
    $this->agencyAddress = $agencyAddress;
  }

  public function getPostalCode() {
    return $this->postalCode;
  }

  public function setPostalCode($postalCode) {
    $this->postalCode = $postalCode;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCity($city) {
    $this->city = $city;
  }

  public function getAnyField() {
    return $this->anyField;
  }

  public function setAnyField($anyField) {
    $this->anyField = $anyField;
  }

  public function getLibraryType() {
    return $this->libraryType;
  }

  public function setLibraryType($libraryType) {
    $this->libraryType = $libraryType;
  }

  public function getLibraryStatus() {
    return $this->libraryStatus;
  }

  public function setLibraryStatus($libraryStatus) {
    $this->libraryStatus = $libraryStatus;
  }

  public function getPickupAllowed() {
    return $this->pickupAllowed;
  }

  public function setPickupAllowed($pickupAllowed) {
    $this->pickupAllowed = $pickupAllowed;
  }

  public function getSort() {
    return $this->sort;
  }

  public function setSort($sort) {
    $this->sort = $sort;
  }

  public function getCallback() {
    return $this->callback;
  }

  public function setCallback($callback) {
    $this->callback = $callback;
  }

  public function getOutputType() {
    return $this->outputType;
  }

  public function setOutputType($outputType) {
    $this->outputType = $outputType;
  }

  protected function getRequest(){
    // sofar only action,agencyId,service is used
    $params =  array('action','agencyId','service');
    foreach ($params as $parameter) {
      $getter = 'get' . ucfirst($parameter);
      if ($value = $this->$getter()) {
        $this->setParameter($parameter, $value);
      }
    }
    return $this;
  }
  // empty;
  public function processResponse(stdClass $result) {
    return $result;
    
  }
}
?>
