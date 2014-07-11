<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\widget\CountryAutocompleteWidget.
 */

namespace Drupal\country\Plugin\Field\FieldWidget;


use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal;


/**
 * Plugin implementation of the 'country_autocomplete' widget.
 *
 * @FieldWidget(
 *   id = "country_autocomplete",
 *   label = @Translation("Country autocomplete widget"),
 *   field_types = {
 *     "country"
 *   }
 * )
 */
class CountryAutocompleteWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'size' => '60',
      'autocomplete_route_name' => 'country.autocomplete',
      'placeholder' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, array &$form_state) {
    $countries = \Drupal::service('country_manager')->getList();
    $element += array(
      '#type' => 'textfield',
      '#default_value' => (isset($items[$delta]->value)) ? $countries[$items[$delta]->value] : '',
      '#autocomplete_route_name' => $this->getSetting('autocomplete_route_name'),
      '#autocomplete_route_parameters' => array(),
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => 255,
      '#element_validate' => array('country_autocomplete_validate'),
    );

    return $element;
  }
}
