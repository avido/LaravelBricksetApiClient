<?php
namespace Avido\LaravelBricksetApiClient\Traits\Endpoints;

/**
 * Validation trait
 *
 */

use Avido\LaravelBricksetApiClient\Exceptions\InvalidParameterException;

trait Validate
{
    /**
     * Available getCollection Params
     * @var array
     */
    private $setCollectionParameterAvailable = [
        'own', 'want', 'qtyOwned', 'notes', 'rating'
    ];
    /**
     * Available getMinifigCollection Params
     * @var array
     */
    private $getMinifigsParameterAvailable = [
        'owned', 'wanted', 'query'
    ];
    /**
     * Available setMinifigCollection params
     * @var array
     */
    private $setMinifigsParameterAvailable = [
        'own', 'want', 'qtyOwned'
    ];

    /**
     * Validate params
     *
     * @param array $set - input
     * @param array $available - validate against
     * @return void
     * @throws InvalidParameterException
     */
    private function validateParameters(array $set, array $available): void
    {
        foreach (array_keys($set) as $key) {
            if (!in_array($key, $available)) {
                throw new InvalidParameterException(
                    "'{$key}' is a non valid parameter, valid parameters are: " . implode(",", $available)
                );
            }
        }
    }
}
