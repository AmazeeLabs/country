<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\widget\CountryDefaultWidget.
 */

namespace Drupal\country\Plugin\field\widget;

use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\field\Plugin\Type\Widget\WidgetBase;

/**
 * Plugin implementation of the 'country_default' widget.
 *
 * @Plugin(
 *   id = "country_default",
 *   module = "country",
 *   label = @Translation("Country select"),
 *   field_types = {
 *     "country"
 *   }
 * )
 */
class CountryDefaultWidget extends WidgetBase {
    
  /**
   * Implements Drupal\field\Plugin\Type\Widget\WidgetInterface::formElement().
   */
  public function formElement(array $items, $delta, array $element, $langcode, array &$form, array &$form_state) {
    $element['value'] = $element + array(
      '#type' => 'select',
      '#options' => country_get_list(),
      '#empty_value' => '',
      '#default_value' => isset($items[$delta]['iso2']) ? $items[$delta]['iso2'] : NULL,
      '#description' => t('Select a country ...'),
    );
    return $element;
  }
}