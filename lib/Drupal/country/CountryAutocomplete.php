<?php

/**
 * @file
 * Contains \Drupal\country\CountryAutocomplete.
 */

namespace Drupal\country;

use Drupal;

/**
 * Defines a helper class to get user autocompletion results.
 */
class CountryAutocomplete {

  /**
   * Constructs a CountryAutocomplete object.
   */
  public function __construct() {}

  /**
   * Get matches for the autocompletion of country names.
   *
   * @param string $string
   *   The string to match for country names.
   *
   * @return array
   *   An array containing the matching country names.
   */
  public function getMatches($string) {
    $matches = array();
    if ($string) {
      $countries = Drupal::service('country_manager')->getList();
      foreach ($countries as $iso2 => $country) {
        if (strpos(drupal_strtolower($country), drupal_strtolower($string)) !== FALSE) {
          $matches[] = array('value' => $country, 'label' => $country);
        }
      }
    }
    return $matches;
  }

}
