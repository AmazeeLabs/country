<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\widget\CountryDefaultWidget.
 */

namespace Drupal\country\Plugin\field\widget;

use Drupal\field\Annotation\FieldWidget;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Field\FieldInterface;
use Drupal\field\Plugin\Type\Widget\WidgetBase;
use Drupal;


/**
 * Plugin implementation of the 'country_default' widget.
 *
 * @FieldWidget(
 *   id = "country_default",
 *   module = "country",
 *   label = @Translation("Country select"),
 *   field_types = {
 *     "country"
 *   },
 *   multiple_values = TRUE
 * )
 */
class CountryDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldInterface $items, $delta, array $element, $langcode, array &$form, array &$form_state) {
    $element['value'] = $element + array(
        '#type' => 'select',
        '#options' => Drupal::service('country_manager')->getList(),
        '#empty_value' => '',
        '#default_value' => isset($items[$delta]->iso2) ? $items[$delta]->iso2 : NULL,
        '#description' => t('Select a country'),
      );
    return $element;
  }
}
