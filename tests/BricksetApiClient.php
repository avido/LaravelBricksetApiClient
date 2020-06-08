<?php
namespace Avido\LaravelBricksetApiClient\Tests;

use Avido\LaravelBricksetApiClient\BricksetApiClient as BaseClient;

class BricksetApiClient extends BaseClient
{
    private $hash;

    /**
     * Get UserHash
     * @return string
     * @throws Exceptions\jsonDecodeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws invalidCredentialsException
     */
    protected function getUserHash(): string
    {
        $this->hash = 'fakehash';
        return $this->hash;
    }
    /**
     * Validate user hash
     * @return bool
     * @throws Exceptions\errorResponseException
     * @throws Exceptions\jsonDecodeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws invalidCredentialsException
     */
    public function checkUserHash(): bool
    {
        if (is_null($this->hash)) {
            throw new invalidParameterException("Hash not set, call login first");
        }
        return true;
    }
}
