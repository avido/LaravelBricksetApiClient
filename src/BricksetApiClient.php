<?php
namespace Avido\LaravelBricksetApiClient;

/**
 * Class BricketApiClient
 * @package Avido\LaravelBricksetApiClient
 *
 * Bricket API Client
 * @see https://brickset.com/tools/webservices/v3
 * Available (public) methods:
 *  - setClient
 *  - login
 *  - checkUserHash
 *  - getKeyUsageStats
 * Available Endpoint methods:
 *  - getMinifigCollection
 *  - setMinifigCollection
 *  - getSets
 *  - getAdditionalImages
 *  - getInstructions
 *  - getThemes
 *  - getSubthemes
 *  - getYears
 *  - setCollection
 *  - getUserNotes
 */

use Avido\LaravelBricksetApiClient\Exceptions\ConfigruationException;
use Avido\LaravelBricksetApiClient\Exceptions\InvalidCredentialsException;
use Avido\LaravelBricksetApiClient\Exceptions\InvalidParameterException;
use Avido\LaravelBricksetApiClient\Traits\Endpoints\Minifigs;
use Avido\LaravelBricksetApiClient\Traits\Endpoints\Validate;
use Avido\LaravelBricksetApiClient\Traits\Methods;
use Avido\LaravelBricksetApiClient\Traits\SerializeHelper;
use Avido\LaravelBricksetApiClient\Traits\Endpoints\Sets;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BricksetApiClient
{
    use SerializeHelper, Methods, Validate, Sets, Minifigs;

    const API_ADDRESS = "https://brickset.com/api/v3.asmx/";

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string - apiKey
     */
    private $apiKey;
    /**
     * @var string - Username
     */
    private $username;
    /**
     * @var string - Password
     */
    private $password;

    /**
     * @var string - Auth hash response from login()
     */
    private $hash;

    public function __construct(
        ?string $apiKey = null,
        ?string $username = null,
        ?string $password = null
    ) {
        $this->apiKey = $apiKey ?? config('brickset-api.api.apikey');
        $this->username = $username ?? config('brickset-api.api.username');
        $this->password = $password ?? config('brickset-api.api.password');
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }
    /**
     * Set Client
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Login to API
     * @return bool
     * @throws Exceptions\JsonDecodeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws InvalidCredentialsException
     */
    public function login()
    {
        try {
            $response = $this->getClient()->request('POST', 'login', [
                'form_params' => [
                    'apikey' => $this->getApiKey(),
                    'username' => $this->getUsername(),
                    'password' => $this->getPassword()
                ]
            ]);
            // decode response
            $data = $this->jsonToObject($response->getBody()->getContents());
            if ($data->status === 'success') {
                $this->hash = $data->hash;
                return true;
            }
        } catch (ClientException $e) {
        }
        // failed to authenticate
        throw new InvalidCredentialsException();
    }

    /**
     * Get UserHash
     * @return string
     * @throws Exceptions\JsonDecodeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws InvalidCredentialsException
     */
    protected function getUserHash(): string
    {
        if (is_null($this->hash) || !$this->checkUserHash()) {
            $this->login();
        }
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
            throw new InvalidParameterException("Hash not set, call login first");
        }
        $response = $this->post('checkUserHash', [
            'userHash' => $this->hash
        ]);
        return $response->status === 'success';
    }

    /**
     * Get Key Usage Stats
     * @return mixed
     * @throws Exceptions\ErrorResponseException
     */
    public function getKeyUsageStats()
    {
        return $this->post('getKeyUsageStats');
    }
    /**
     * Get Api Key
     * @return string
     * @throws ConfigruationException
     */
    private function getApiKey(): string
    {
        if (is_null($this->apiKey)) {
            throw new ConfigruationException('Api Key not defined');
        }
        return $this->apiKey;
    }

    /**
     * Get Username
     * @return string
     * @throws ConfigruationException
     */
    private function getUsername(): string
    {
        if (is_null($this->username)) {
            throw new ConfigruationException('Username not defined');
        }
        return $this->username;
    }

    /**
     * Get Password
     * @return string
     * @throws ConfigruationException
     */
    private function getPassword(): string
    {
        if (is_null($this->password)) {
            throw new ConfigruationException('Password not defined');
        }
        return $this->password;
    }

    /**
     * Get Client
     * @return Client|ClientInterface
     */
    private function getClient()
    {
        if (!$this->client instanceof ClientInterface) {
            $this->client = new Client([
                'base_uri' => self::API_ADDRESS,
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
        }
        return $this->client;
    }
}
