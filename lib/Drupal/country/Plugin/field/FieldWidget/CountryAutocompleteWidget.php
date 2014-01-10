<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\widget\CountryAutocompleteWidget.
 */

namespace Drupal\country\Plugin\Field\FieldWidget;


use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\FieldInterface;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal;


/**
 * Plugin implementation of the 'country_autocomplete' widget.
 *
 * @FieldWidget(
 *   id = "country_autocomplete",
 *   module = "country",
 *   label = @Translation("Country autocomplete widget"),
 *   field_types = {
 *     "country"
 *   },
 *   settings = {
 *     "size" = "60",
 *     "autocomplete_route_name" = "country_autocomplete",
 *     "placeholder" = ""
 *   }
 * )
 */
class CountryAutocompleteWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, array &$form_state) {
    $countries = Drupal::service('country_manager')->getList();
    $element['value'] = $element + array(
        '#type' => 'textfield',
        '#default_value' => (isset($items[$delta]->value)) ? $countries[$items[$delta]->value] : '',
        '#autocomplete_route_name' => $this->getSetting('autocomplete_route_name'),
        '#autocomplete_route_parameters' => array(),
        '#size' => $this->getSetting('size'),
        '#placeholder' => $this->getSetting('placeholder'),
        '#maxlength' => 255,
      );

    return $element;
  }

  /**
   * Implements Drupal\field\Plugin\Type\Widget\WidgetInterface::massageFormValues()
   */
  public function massageFormValues(array $values, array $form, array &$form_state) {
    // Autocomplete widgets only send the country name in the form, so we must detect them
    // here and process them independently so that we have values for the ISO2
    $items = array();
    $countries = Drupal::service('country_manager')->getList();
    foreach ($values as $value) {
      if (drupal_strlen($value['value'])) {
        foreach ($countries as $iso2 => $country) {
          if ($country == $value['value']) {
            $items[] = array('value' => $iso2);
            break;
          }
        }
      }
    }
    return $items;
  }

}
