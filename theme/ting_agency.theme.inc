<?php

/**
 * preprocess function for library template (ting_agency_library.tpl.php)
 */
function template_preprocess_ting_agency_library(&$variables) {
  if (isset($variables['add_classes'])) {
    $variables['classes_array'] = array_merge($variables['classes_array'], $variables['add_classes']);
  }
}

/** \brief Theme contact info
 *
 * @param array $variables
 * @return string (html)
 */
function theme_ting_agency_contact($variables) {
  $branch = $variables['branch'];
  $contact_array = $branch->getContact();
  $output = '';
  if (!empty($contact_array)) {
    foreach ($contact_array as $key => $value) {
      $output .= $key . ' : ' . $value . '<br/>';
    }
  }
  return $output;
}

/** \brief Theme agency opening hourt
 *
 * @global stdObject $language
 * @param array $variables
 * @return string (html) 
 */
function theme_ting_agency_opening_hours($variables) {
  $branch = $variables['branch'];
  global $language;
  $lang = $language->language;
  $render_array = array('#markup' => $branch->getOpeningHours($lang));
  if (empty($render_array)) {
    return NULL;
  }
  return drupal_render($render_array);
}

/** \brief Theme links given from agency
 *
 * @param array $variables
 * @return string (html unordered list)
 */
function theme_ting_agency_tools($variables) {
  $branch = $variables['branch'];
  $links = $branch->getActionLinks();
  $items = array();
  if (!empty($links)) {
    foreach ($links as $name => $link) {
      $item['data'] = l($name, $link, array());
      $items[] = $item;
    }
    return theme('item_list', array('items' => $items));
  }
}

/** \brief Theme address for given agency
 *
 * @param array $variables
 * @return string (html) 
 */
function theme_ting_agency_address($variables) {
  $branch = $variables['branch'];
  $address = $branch->getAddress();
  return $address;
}

?>