<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\formatter\CountryDefaultFormatter.
 */

namespace Drupal\country\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal;


/**
 * Plugin implementation of the 'country' formatter.
 *
 * @FieldFormatter(
 *   id = "country_default",
 *   module = "country",
 *   label = @Translation("Country"),
 *   field_types = {
 *     "country"
 *   }
 * )
 */
class CountryDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $elements = array();
    $allowed_values = Drupal::service('country_manager')->getList();
    foreach ($items as $delta => $item) {
      $elements[$delta] = array('#markup' => $allowed_values[$item->value]);
    }
    return $elements;
  }
}
