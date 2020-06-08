<?php
namespace Avido\LaravelBricksetApiClient\Traits;

/**
 * Trait SerializeHelper
 * @package Avido\LaravelBricksetApiClient\Traits
 *
 * Decode/Unserialize helper
 */
use Avido\LaravelBricksetApiClient\Exceptions\JsonDecodeException;

trait SerializeHelper
{
    /**
     * Json to object.
     * @param string $json
     * @return \stdClass
     * @throws JsonDecodeException
     */
    public function jsonToObject(string $json): \stdClass
    {
        $object = json_decode($json);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonDecodeException("Failed to decode json: '" . json_last_error() . "'");
        }
        return $object;
    }

    /**
     * Json to array
     *
     * @param string $json
     * @return array
     * @throws JsonDecodeException
     */
    public function jsonToArray(string $json): array
    {
        $object = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonDecodeException("Failed to decode json: '" . json_last_error() . "'");
        }
        return $object;
    }
}
