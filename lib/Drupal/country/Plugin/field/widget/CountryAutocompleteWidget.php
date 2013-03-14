<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\widget\CountryAutocompleteWidget.
 */

namespace Drupal\country\Plugin\field\widget;

use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\field\Plugin\Type\Widget\WidgetBase;


/**
 * Plugin implementation of the 'country_autocomplete' widget.
 *
 * @Plugin(
 *   id = "country_autocomplete",
 *   module = "country",
 *   label = @Translation("Country autocomplete"),
 *   field_types = {
 *     "country"
 *   },
 *   settings = {
 *     "size" = "60",
 *     "autocomplete_path" = "country/autocomplete",
 *     "placeholder" = ""
 *   },
 *   multiple_values = TRUE
 * )
 */
class CountryAutocompleteWidget extends WidgetBase {

  /**
   * Implements Drupal\field\Plugin\Type\Widget\WidgetInterface::formElement().
   */
  public function formElement(array $items, $delta, array $element, $langcode, array &$form, array &$form_state) {
    $field = $this->field;
    $element['value'] = $element + array(
      '#type' => 'textfield',
      '#default_value' => (count($items)) ? $items[$delta]['country'] : '',
      '#empty_value' => '',
      '#autocomplete_path' => $this->getSetting('autocomplete_path'), // . '/' . $field['field_name'],
      '#maxlength' => 255,
    );
    
    return $element;
  }
  
  /**
   * Implements Drupal\field\Plugin\Type\Widget\WidgetInterface::massageFormValues()
   */
  public function massageFormValues(array $values, array $form, array &$form_state) {
    $items = array();
    $countries = country_get_list();
    foreach($countries as $iso2 => $country) {
      if($country == $values['value']) {
        $items[0]['value'] = $iso2;
        break;
      }
    }
    
    return $items;
  }
  
}
