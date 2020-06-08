<?php
namespace Avido\LaravelBricksetApiClient\Traits\Endpoints;

/**
 * Trait Minifigs
 * @package Avido\LaravelBricksetApiClient\Traits\Endpoints
 *
 * Minifigs related trait
 */

trait Minifigs
{
    /**
     * Get Minifig Collection
     * Get a list of minifigs owned/wanted by a user.
     * Params:
     * - owned      # Set to 1 to retrieve minifigs owned
     * - wanted     # Set to 1 to retrieve minifigs wanted
     * - query      # This can be a minifig number or name. Wildcards are added before and after.
     *              If omitted, all minifigs owned are returned.
     * @param array $params
     * @return \stdClass
     */
    public function getMinifigCollection(array $params): \stdClass
    {
        $this->validateParameters($params, $this->getMinifigsParameterAvailable);
        return $this->post('getMinifigCollection', [
            'userHash' => $this->getUserHash(),
            'params' => json_encode($params)
        ]);
    }

    /**
     * Set Minifig Collection
     * Add/change a user's 'loose' minifig collection.
     *
     * Params:
     * - own        # 1 or 0. If 0 then qtyOwned is automatically set to 0
     * - want       # 1 or 0
     * - qtyOwned   0-999. If > 0 then own is automatically set to 1
     * @param string $minifigNumber
     * @param array $params
     * @return \stdClass
     */
    public function setMinifigCollection(string $minifigNumber, array $params): \stdClass
    {
        $this->validateParameters($params, $this->setMinifigsParameterAvailable);
        return $this->post('setMinifigCollection', [
            'userHash' => $this->getUserHash(),
            'minifigNumber' => $minifigNumber,
            'params' => json_encode($params)
        ]);
    }
}
