<?php

/**
 * @file
 * Contains \Drupal\country\Controller\CountryAutocompleteController.
 */

namespace Drupal\country\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\country\CountryAutocomplete;


/**
 * Returns autocomplete responses for countries.
 */
class CountryAutocompleteController implements ContainerInjectionInterface {

  /**
   * The user autocomplete helper class to find matching user names.
   *
   * @var \Drupal\country\CountryAutocomplete
   */
  protected $countryAutocomplete;

  /**
   * Constructs a CountryAutocompleteController object.
   *
   * @param \Drupal\country\CountryAutocomplete $country_autocomplete
   *   The country autocomplete helper class to find matching country names.
   */
  public function __construct(CountryAutocomplete $country_autocomplete) {
    $this->countryAutocomplete = $country_autocomplete;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('country.autocomplete')
    );
  }

  /**
   * Returns response for the country name autocompletion.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request object containing the search string.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response containing the autocomplete suggestions for countries.
   *
   * @see getMatches()
   */
  public function autocomplete(Request $request) {
    $matches = $this->countryAutocomplete->getMatches($request->query->get('q'));
    return new JsonResponse($matches);
  }


}
