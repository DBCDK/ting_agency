<?php

/**
 * Handle settings for Agency specific form fields
 *
 * This function is prepared to manifestation specific userinput
 */
class AgencyFields {

  public $userParameters, $userIdTxt, $customIdTxt, $orderParameters, $agencyParameters, $response;

  public function __construct($response) {
    $response = $this->_parse_agency_service_response($response);
    foreach ($response as $key => $value) {
      $this->$key = $value;
    }
    $this->response = $response;

    if( isset( $this->userParameters ) ) {
    foreach ($this->userParameters as $key => $element) {
      $this->userParameters[$key] += $this->_getSettingsFromType($element['type']);
    }
  }
  }

  public function getUserParameters() {
    return $this->userParameters;
  }

  public function getOrderParameters() {
    return $this->orderParameters;
  }

  public function getOrderParametersForType($type, $orderType = 'ill') {
    if (!isset($this->orderParameters))
      return;
    foreach ($this->orderParameters as $orderParameter) {
      if ($orderParameter['materialType'] == $type && $orderParameter['orderType'] == $orderType) {
        return isset($orderParameter['itemParameters']) ? $orderParameter['itemParameters'] : NULL;
      }
    }
  }

  public function getUserIdKey() {
    foreach ($this->userParameters as $key => $element) {
      if (in_array($element['type'], array('cpr', 'userId', 'cardno', 'customId'))) {
        return $element['type'];
      }
    }
  }

  public function isBorrowerCheckRequired() {
    return $this->agencyParameters['borrowerCheckParameters']['bibliotek.dk'];
  }

  public function acceptOrderFromUnknownUser() {
    return $this->agencyParameters['acceptOrderFromUnknownUser'];
  }

  public function acceptOrderAgencyOffline() {
    return $this->agencyParameters['acceptOrderAgencyOffline'];
  }

  public function getOrderLabelFromType($type) {
    switch ($type) {
      case 'authorOfComponent' :
        return t('authorOfComponent');
        break;
      case 'issue' :
        return t('issue');
        break;
      case 'pagination' :
        return t('pagination');
        break;
      case 'publicationDateOfComponent' :
        return t('publicationDateOfComponent');
        break;
      case 'userReferenceSource' :
        return t('userReferenceSource');
        break;
      case 'titleOfComponent' :
        return t('titleOfComponent');
        break;
      case 'volume' :
        return t('volume');
        break;
      default:
        break;
    }
  }

  private function _getSettingsFromType($type) {
    global $language ;
    $lang = strtr($language->language, array('da'=>'dan','en-gb'=>'eng','en'=>'eng'));
    $settings = array();

    switch ($type) {
      case 'cpr':
        $settings = array(
          'field_name' => t('CPR-number'),
          'field_type' => 'password',
          //'field_description' => isset($this->userIdTxt) ? implode(", ", $this->userIdTxt) : NULL,
        );
        break;
      case 'userId':
        $settings = array(
          'field_name' => isset($this->userIdTxt[$lang]) ? check_plain($this->userIdTxt[$lang]) : ( isset($this->userIdTxt) ? check_plain(implode(", ", $this->userIdTxt)) : t('User ID')),
          //'field_description' => isset($this->userIdTxt) ? implode(", ", $this->userIdTxt) : NULL,
        );
        break;

      case 'cardno':
        $settings = array(
          'field_name' => t('Card number'),
          'field_type' => 'password',
          //'field_description' => isset($this->userIdTxt) ? implode(", ", $this->userIdTxt) : NULL,
        );
        break;
      case 'customId':
        $settings = array(
          'field_name' => isset($this->customIdTxt[$lang]) ? check_plain($this->customIdTxt[$lang]) : ( isset($this->customIdTxt) ? check_plain(implode(", ", $this->customIdTxt)) : t('Custom ID')),
          'field_type' => 'password',
          //'field_description' => isset($this->customIdTxt) ? implode(", ", $this->customIdTxt) : NULL,
        );
        break;
      case 'barcode':
        $settings = array(
          'field_name' => t('Barcode'),
          'field_type' => 'password',
          //'field_description' => isset($this->userIdTxt) ? implode(", ", $this->userIdTxt) : NULL,
        );
        break;
      case 'pincode':
        $settings = array(
          'field_name' => t('Pincode'),
          'field_type' => 'password',
        );
        break;
      case 'userDateOfBirth':
        $settings = array(
          'field_name' => t('Date of birth'),
        );
        break;
      case 'userName':
        $settings = array(
          'field_name' => t('Name'),
        );
        break;
      case 'userAddress':
        $settings = array(
          'field_name' => t('Adress, postal code, town/city'),
        );
        break;
      case 'userMail':
        $settings = array(
          'field_name' => t('E-mail'),
        );
        break;
      case 'userTelephone':
        $settings = array(
          'field_name' => t('Phone number'),
        );
        break;

      default:
        break;
    }

    return $settings;
  }

  /**
 * Parse json response from ServiceRequest
 * @param json $response
 * @return array
 */
private function _parse_agency_service_response($response) {
  $result = array();
  if (isset($response->userParameter)) {
    foreach ($response->userParameter as $userParameter) {

      $result['userParameters'][] = array(
        'type' => $userParameter->userParameterType->{'$'},
        'required' => $userParameter->parameterRequired->{'$'},
      );
    }
  }
  if (isset($response->userIdTxt)) {
    foreach ($response->userIdTxt as $txt) {
      $result['userIdTxt'][$txt->{'@language'}->{'$'}] = $txt->{'$'};
    }
  }
  if (isset($response->customIdTxt)) {
    foreach ($response->customIdTxt as $txt) {
      $result['customIdTxt'][$txt->{'@language'}->{'$'}] = $txt->{'$'};
    }
  }
  if (isset($response->orderParameters)) {
    foreach ($response->orderParameters as $key => $orderParameter) {
      $result['orderParameters'][$key] = array(
        'materialType' => $orderParameter->orderMaterialType->{'$'},
        'orderType' => $orderParameter->orderType->{'$'},
      );
      if (isset($orderParameter->itemParameter)) {
        $itemParameters = array();
        foreach ($orderParameter->itemParameter as $itemParameter) {
          $itemParameters[] = array(
            'type' => $itemParameter->itemParameterType->{'$'},
            'required' => $itemParameter->parameterRequired->{'$'},
          );
        }
        $result['orderParameters'][$key]['itemParameters'] = $itemParameters;
      }
    }
  }
  if (isset($response->agencyParameters->borrowerCheckParameters)) {
    foreach ($response->agencyParameters->borrowerCheckParameters as $key => $borrowerCheckParamerters) {
      $result['agencyParameters']['borrowerCheckParameters'][$borrowerCheckParamerters->borrowerCheckSystem->{'$'}] = $borrowerCheckParamerters->borrowerCheck->{'$'};
    }
    $result['agencyParameters']['acceptOrderFromUnknownUser'] = $response->agencyParameters->acceptOrderFromUnknownUser->{'$'};
    $result['agencyParameters']['acceptOrderAgencyOffline'] = $response->agencyParameters->acceptOrderAgencyOffline->{'$'};
  }
  return $result;
}


}