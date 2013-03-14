<?php

/**
 * @file
 * Definition of Drupal\country\Plugin\field\formatter\TextDefaultFormatter.
 */

namespace Drupal\country\Plugin\field\formatter;

use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\field\Plugin\Type\Formatter\FormatterBase;
use Drupal\Core\Entity\EntityInterface;

/**
 * Plugin implementation of the 'text_default' formatter.
 *
 * @Plugin(
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
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::viewElements().
   */
  public function viewElements(EntityInterface $entity, $langcode, array $items) {
    $elements = array();
    foreach ($items as $delta => $item) {
      $elements[$delta] = array('#markup' => $item['country']);
    }
    return $elements;
  }

}
