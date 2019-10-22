<?php

class TingClientAgencyBranch {

  public $branchId;
  public $agencyId;
  private $branchName;
  private $branchShortName;
  public $branchPhone;
  public $branchEmail;
  public $branchIsAgency;
  public $postalAddress;
  public $postalCode;
  public $city;
  public $junction;
  public $branchWebsiteUrl;
  public $serviceDeclarationUrl;
  public $openingHours;
  public $temporarilyClosed;
  private $temporarilyClosedReason;
  public $illOrderReceiptText;
  private $userStatusUrl;
  public $agencyName;
  public $librarydkSupportEmail;
  public $librarydkSupportPhone;
  private $paymentUrl;
  public $pickupAllowed;
  public $getDataArray;
  public $pickupAgency;
  private $ncipLookUpUser;
  public $dropOffBranch;
  public $dropOffName;
  public $userdata;
  public $orderLibrary;
  private $agencyEanNumber;
  private $agencyCvrNumber;
  private $agencyPNumber;
  private $branchPNumber;
  private $branchIllEmail;
  private $registrationFormUrl;
  private $registrationFormUrlText;
  private $headOfBranchName;
  private $headOfInstitutionName;
  private $serviceTxt;

  public function __construct($pickupAgency, $agencyName = NULL, $agencyId = NULL) {
    if (isset($agencyId)) {
      $this->branchId = $agencyId;
    }
    elseif (!empty($pickupAgency)) {
      if (!isset($pickupAgency->agencyName)) {
        $this->agencyName = $agencyName;
      }
      $this->pickupAgency = $pickupAgency;
      $this->set_attributes($pickupAgency);
    }
    else {
      throw new TingClientAgencyBranchException('TingClientAgencyBranch constructor needs either agencyid or findlibraryresponse (openagency.addi.dk)');
    }
  }

  private function set_attributes($pickupAgency) {
    $this->branchId = TingClientRequest::getValue($pickupAgency->branchId);
    $this->branchName = $pickupAgency->branchName;
    $this->branchPhone = TingClientRequest::getValue($pickupAgency->branchPhone);
    $this->branchEmail = TingClientRequest::getValue($pickupAgency->branchEmail);

    if (isset($pickupAgency->branchIsAgency)) {
      $this->branchIsAgency = TingClientRequest::getValue($pickupAgency->branchIsAgency);
    }
    if (isset($pickupAgency->branchShortName)) {
      $this->branchShortName = $pickupAgency->branchShortName;
    }
    if (isset($pickupAgency->postalAddress)) {
      $this->postalAddress = TingClientRequest::getValue($pickupAgency->postalAddress);
    }
    if (isset($pickupAgency->agencyId)) {
      $this->agencyId = TingClientRequest::getValue($pickupAgency->agencyId);
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
    if (isset($pickupAgency->temporarilyClosedReason)) {
      $this->temporarilyClosedReason = $pickupAgency->temporarilyClosedReason;
    }
    if (isset($pickupAgency->illOrderReceiptText)) {
      $this->illOrderReceiptText = $pickupAgency->illOrderReceiptText;
    }
    if (isset($pickupAgency->userStatusUrl)) {
      $this->userStatusUrl = TingClientRequest::getValue($pickupAgency->userStatusUrl);
    }
    if (isset($pickupAgency->agencyName)) {
      $this->agencyName = TingClientRequest::getValue($pickupAgency->agencyName);
    }
    //librarydkSupportPhone
    if (isset($pickupAgency->librarydkSupportPhone)) {
      $this->librarydkSupportPhone = TingClientRequest::getValue($pickupAgency->librarydkSupportPhone);
    }
    //librarydkSupportEmail
    if (isset($pickupAgency->librarydkSupportEmail)) {
      $this->librarydkSupportEmail = TingClientRequest::getValue($pickupAgency->librarydkSupportEmail);
    }
    if (isset($pickupAgency->paymentUrl)) {
      $this->paymentUrl = TingClientRequest::getValue($pickupAgency->paymentUrl);
    }
    //pickupAllowed for library
    if (isset($pickupAgency->pickupAllowed)) {
      $this->pickupAllowed = TingClientRequest::getValue($pickupAgency->pickupAllowed);
    }
    if (isset($pickupAgency->ncipLookupUser)) {
      $this->ncipLookUpUser = TingClientRequest::getValue($pickupAgency->ncipLookupUser);
    }
    //registrationFormUrlText
    if (isset($pickupAgency->registrationFormUrlText)) {
      $this->registrationFormUrlText = TingClientRequest::getValue($pickupAgency->registrationFormUrlText);
    }
    //registrationFormUrl
    if (isset($pickupAgency->registrationFormUrl)) {
      $this->registrationFormUrl = TingClientRequest::getValue($pickupAgency->registrationFormUrl);
    }
    // cvr company main location.
    if (isset($pickupAgency->agencyCvrNumber)) {
      $this->agencyCvrNumber = TingClientRequest::getValue($pickupAgency->agencyCvrNumber);
    }
    // p number - sub company location
    if (isset($pickupAgency->agencyPNumber)) {
      $this->agencyPNumber = TingClientRequest::getValue($pickupAgency->agencyPNumber);
    }
    // EAN Number. Used for e invoice.
    if (isset($pickupAgency->agencyEanNumber)) {
      $this->agencyEanNumber = TingClientRequest::getValue($pickupAgency->agencyEanNumber);
    }
    if (isset($pickupAgency->junction)) {
      $this->junction = TingClientRequest::getValue($pickupAgency->junction);
    }
    if (isset($pickupAgency->dropOffBranch)) {
      $this->dropOffBranch = TingClientRequest::getValue($pickupAgency->dropOffBranch);
    }
    if (isset($pickupAgency->dropOffName)) {
      $this->dropOffName = TingClientRequest::getValue($pickupAgency->dropOffName);
    }
    if (isset($pickupAgency->headOfBranchName)) {
      $this->headOfBranchName = TingClientRequest::getValue($pickupAgency->headOfBranchName);
    }
    if (isset($pickupAgency->headOfInstitutionName)) {
      $this->headOfInstitutionName = TingClientRequest::getValue($pickupAgency->headOfInstitutionName);
    }
    if (isset($pickupAgency->branchPNumber)) {
      $this->branchPNumber = TingClientRequest::getValue($pickupAgency->branchPNumber);
    }

  }

  /**
   * Does branch want a shippingnote?.
   * @return int
   */
  public function getNationalDeliveryService(){
    return isset($this->pickupAgency->nationalDeliveryService) ? $this->pickupAgency->nationalDeliveryService->{'$'} : 0;
  }

  public function getStateAndUniversityLibraryCopyService() {
    return isset($this->pickupAgency->stateAndUniversityLibraryCopyService->{'$'}) ?
      $this->pickupAgency->stateAndUniversityLibraryCopyService->{'$'} : 0;
  }

  public function getTemporarilyClosedReason($lang) {
    $lang = $this->drupalLangToServiceLang($lang);
    $ret = "";
    if ($this->temporarilyClosed) {
      if (isset($this->temporarilyClosedReason)) {
        $temporarilyClosedReasons = $this->temporarilyClosedReason;
        if (is_array($temporarilyClosedReasons)) {
          foreach ($temporarilyClosedReasons as $ClosedReason) {
            if ($ClosedReason->{'@language'}->{'$'} == $lang) {
              $ret = $ClosedReason->{'$'};
            }
          }
          if (empty($ret)) {
            // given lanuguage was not found..simply return first in array
            $ret = $ClosedReason->{'$'};
          }
        }
      }
    }
    else {
      $ret = t('ting_agency_no_temporarilyClosedReason', array(), array('context' => 'ting_agency'));
    }
    return $ret;
  }

  public function getServiceTxt(){
    return isset($this->pickupAgency->branchServiceTxt) ? $this->pickupAgency->branchServiceTxt->{'$'} : NULL;
  }

  /**
   * dropOffBranch
   */
  public function getDropOffBranch() {
    return isset($this->pickupAgency->dropOffBranch) ? $this->pickupAgency->dropOffBranch->{'$'} : NULL;
  }

  /**
   * dropOffName
   */
  public function getDropOffName() {
    return isset($this->pickupAgency->dropOffName) ? $this->pickupAgency->dropOffName->{'$'} : NULL;
  }

  /**
   * junction
   */
  public function getJunction() {
    return isset($this->pickupAgency->junction) ? $this->pickupAgency->junction->{'$'} : NULL;
  }

  /**
   * CVR
   */
  public function getCVRNumber() {
    return isset($this->pickupAgency->agencyCvrNumber) ? $this->pickupAgency->agencyCvrNumber->{'$'} : NULL;
  }

  /**
   * branchIllEmail;
   */
  public function getBranchIllEmail(){
    return isset($this->pickupAgency->branchIllEmail) ? $this->pickupAgency->branchIllEmail->{'$'} : NULL;
  }

  /**
   * agencyPNumber
   */
  public function getPNumber() {
    return isset($this->pickupAgency->agencyPNumber) ? $this->pickupAgency->agencyPNumber->{'$'} : NULL;
  }

  /**
   * Agency EAN Number
   * @return string
   */
  public function getAgencyEANNumber() {
    return $this->agencyEanNumber;
  }

  /** Check if branch is set as order Library
   * @return bool
   */
  public function isOrderLibrary() {
    return (isset($this->orderLibrary) && $this->orderLibrary == 'TRUE');
  }

  public function getBranchId() {
    return isset($this->pickupAgency->branchId) ? $this->pickupAgency->branchId->{'$'} : NULL;
  }

  public function getBranchType() {
    return isset($this->pickupAgency->branchType) ? $this->pickupAgency->branchType->{'$'} : NULL;
  }

  /**
   * @return string
   */
  public function getLookupUrl() {
    return isset($this->pickupAgency->lookupUrl) ? $this->pickupAgency->lookupUrl->{'$'} : NULL;
  }

  /**
   * @return bool
   */
  public function getIsOclcRsLibrary() {
    return isset($this->pickupAgency->isOclcRsLibrary) ? $this->pickupAgency->isOclcRsLibrary->{'$'} : NULL;
  }

  /** Check if branch will receive ILL requests
   * @return bool
   */
  public function getWillReceiveIll() {
    return (isset($this->pickupAgency->willReceiveIll) && $this->pickupAgency->willReceiveIll->{'$'} == '1') ? TRUE : FALSE;
  }

  /** Get text describing why branch will not receive ILL requests
   * @return string
   */
  public function getWillReceiveIllTxt() {
    return isset($this->pickupAgency->willReceiveIllTxt) ? $this->pickupAgency->willReceiveIllTxt->{'$'} : NULL;
  }

  public function getNcipUpdateOrder() {
    $pickupAgency = $this->pickupAgency;
    if (isset($pickupAgency->ncipUpdateOrder)) {
      return TingClientRequest::getValue($pickupAgency->ncipUpdateOrder);
    }
  }

  public function getNcipRenewOrder() {
    $pickupAgency = $this->pickupAgency;
    if (isset($pickupAgency->ncipRenewOrder)) {
      return TingClientRequest::getValue($pickupAgency->ncipRenewOrder);
    }
  }

  public function getBranchShortName($lang = 'dan') {
    $lang = $this->drupalLangToServiceLang($lang);
    $branches = $this->branchShortName;
    if (is_array($branches)) {
      foreach ($branches as $branch) {
        if ($branch->{'@language'}->{'$'} == $lang) {
          $ret = $branch->{'$'};
        }
      }
      if (empty($ret)) {
        // given lanuguage was not found..simply return first in array
        $ret = $branch->{'$'};
      }
    }
    // this is for backward compatibility with openagency versions prior to 2.6
    elseif (is_object($branches)) {
      $val = TingClientRequest::getValue($branches);
      if (isset($val)) {
        $ret = $val;
      }
    }
    else {
      // branchname is not set
      $ret = t('ting_agency_no_shortbranch_name');
    }
    return $ret;
  }

  public function getBranchName($lang = 'dan') {
    $lang = $this->drupalLangToServiceLang($lang);
    $branches = $this->branchName;
    if (is_array($branches)) {
      foreach ($branches as $branch) {
        if ($branch->{'@language'}->{'$'} == $lang) {
          $ret = $branch->{'$'};
        }
      }
      if (empty($ret)) {
        // given lanuguage was not found..simply return first in array
        $ret = $branch->{'$'};
      }
    }
    // this is for backward compatibility with openagency versions prior to 2.6
    elseif (is_object($branches)) {
      $val = TingClientRequest::getValue($branches);
      if (isset($val)) {
        $ret = $val;
      }
    }
    else {
      // branchname is not set
      $ret = t('ting_agency_no_branch_name');
    }
    return $ret;
  }

  /**
   * @return string|null
   */
  public function getAgencyName() {
    if ($this->getBranchIsAgency()) {
      return $this->getBranchName();
    }
    return isset($this->agencyName) ? $this->agencyName : NULL;
  }

  /**
   * @return string|null
   */
  public function getPostalCode() {
    return isset($this->postalCode) ? $this->postalCode : NULL;
  }

  /**
   * @return string|null
   */
  public function getCity() {
    return isset($this->city) ? $this->city : NULL;
  }

  /**
   * @return string|null
   */
  public function getBranchEmail() {
    return isset($this->branchEmail) ? $this->branchEmail : NULL;
  }

  /**
   * @return boolean
   */
  public function getBranchIsAgency() {
    return (isset($this->branchIsAgency) && $this->branchIsAgency == '1') ? TRUE : FALSE;
  }

  /**
   * @return string|null
   */
  public function getPaymentUrl() {
    return isset($this->paymentUrl) ? $this->paymentUrl : NULL;
  }

  /**
   * @return bool
   */
  public function getNcipLookUpUser() {
    return $this->ncipLookUpUser;
  }

  /**
   * @return string
   */
  public function getUserStatusUrl() {
    return $this->userStatusUrl;
  }

  private function drupalLangToServiceLang($lang) {
    // drupal en an en-gb = openformat eng
    if ($lang == 'en' || $lang == 'en-gb') {
      $lang = 'eng';
    }
    //drupal da = openformat dan
    if ($lang == 'da') {
      $lang = 'dan';
    }
    return $lang;
  }

  public function getOpeningHours($lang) {
    $lang = $this->drupalLangToServiceLang($lang);

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

  public function getPicupAllowed() {
    $picupallowed = '';
    if (isset($this->pickupAllowed)) {
      if ($this->pickupAllowed == 0) {
        $picupallowed .= t('Biblioteket modtager ikke bestillinger igennem bibliotek.dk');
      }
    }
    return $picupallowed;
  }

  public function getLibrarydkContact() {
    $ret = array();

    //Support for librarydk info:  mail and phone
    if (isset($this->librarydkSupportPhone)) {
      $ret[t('librarydkSupportPhone')] = $this->librarydkSupportPhone;
    }
    if (isset($this->librarydkSupportEmail)) {
      $ret[t('librarydkSupportEmail')] =
        '<a href="mailto:' . $this->librarydkSupportEmail . '?Subject=' . t('LibrarydkSubject') . '">' .
        $this->librarydkSupportEmail . '</a>';
    }

    return $ret;
  }

  public function getContact() {
    $ret = array();
    if (isset($this->branchPhone)) {
      $ret[t('branchPhone')] = $this->branchPhone;
    }
    if (isset($this->branchEmail)) {
      $ret[t('branchEmail')] =
        '<a href="mailto:' . $this->branchEmail . '?Subject=' . t('LibrarySubject') . '">' .
        $this->branchEmail . '</a>';
    }
    $branchIllEmail = $this->getBranchIllEmail();
    if (!empty($branchIllEmail)) {
      $ret[t('branchIllEmail')] =
        '<a href="mailto:' . $branchIllEmail . '?Subject=' . t('LibrarySubject') . '">' .
        $branchIllEmail . '</a>';
    }

    return $ret;
  }

  /**
   * Returns array with agencySubdivisions if any
   *
   * @return array
   */
  public function getAgencySubdivisions() {
    $arr = array();
    if (isset($this->pickupAgency->agencySubdivision)) {
      $arr = $this->parseFields($this->pickupAgency->agencySubdivision);
    }
    return $arr;
  }

  public function getIllOrderReceiptText($lang = 'da') {

    switch ($lang) {
      case "en":
      case "en-gb":
        // drupal en = openformat eng
        $lang = 'eng';
        break;
      case "da":
        //drupal da = openformat dan
        $lang = 'dan';
        break;
      default:
        if (!is_string($lang)) {
          watchdog(
            'ting_agency',
            'getIllOrderReceiptText: language is not set correctly',
            array(),
            WATCHDOG_ERROR);
        }
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

  /**
   * Get text for registrationUrl
   * @return string
   */
  public function getRegistrationFormUrlText() {
    return $this->registrationFormUrlText;
  }

  /**
   * Get url used for registration
   * @return string
   */
  public function getRegistrationFormUrl() {
    return $this->registrationFormUrl;
  }

  /**
   * Get the name of the branch head.
   * @return string
   */
  public function getHeadOfBranchName() {
    return $this->headOfBranchName;
  }

  public function getHeadOfInstitutionName() {
    return $this->headOfInstitutionName;
  }

  /**
   * Get the branch P number.
   * @return mixed
   */
  public function getBranchPNumber() {
    return $this->branchPNumber;
  }

  /**
   * Recursively parses a object into a array
   *
   * @param $object
   * @return array
   */
  private function parseFields($object) {
    if (is_object($object)) {
      $object = (array) $object;
    }
    if (is_array($object)) {
      $arr = array();
      foreach ($object as $key => $val) {
        if ($key !== '@') {
          if ($key === '$') {
            $arr = $this->parseFields($val);
          }
          else {
            $arr[$key] = $this->parseFields($val);
          }
        }
      }
    }
    else {
      $arr = $object;
    }
    return $arr;
  }

}
