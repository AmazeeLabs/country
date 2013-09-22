<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\formatter\CountryDefaultFormatter.
 */

namespace Drupal\country\Plugin\field\formatter;

use Drupal\field\Annotation\FieldFormatter;
use Drupal\Core\Annotation\Translation;
use Drupal\field\Plugin\Type\Formatter\FormatterBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\Field\FieldInterface;
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
  public function viewElements(EntityInterface $entity, $langcode, FieldInterface $items) {
    $elements = array();
    $allowed_values = Drupal::service('country_manager')->getList();
    foreach ($items as $delta => $item) {
      $elements[$delta] = array('#markup' => $allowed_values[$item->value]);
    }
    return $elements;
  }
}
