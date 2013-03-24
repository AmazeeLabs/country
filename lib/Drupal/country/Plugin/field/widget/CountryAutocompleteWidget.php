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
 *   }
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
      '#default_value' => (count($items) && isset($items[$delta]['country'])) ? $items[$delta]['country'] : '',
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
    // Autocomplete widgets only send the country name in the form, so we must detect them 
    // here and process them independently so that we have values for both ISO2 and country names
    $items = array();
    $countries = country_get_list();
    foreach ($values as $entry) {
      if (drupal_strlen($entry['value'])) {
        foreach ($countries as $iso2 => $country) {
          if ($country == $entry['value']) {
            $items[] = array('value' => $iso2);
            break;
          }
        }
      }
    }
    return $items;
  }

}
