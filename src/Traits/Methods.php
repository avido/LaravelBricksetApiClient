<?php
namespace Avido\LaravelBricksetApiClient\Traits;

/**
 * Api Methods
 */
use Avido\LaravelBricksetApiClient\Exceptions\BadResponseException;
use Avido\LaravelBricksetApiClient\Exceptions\ErrorResponseException;

trait Methods
{
    /**
     * GET method
     * @param string $endpoint
     * @param array $arguments
     * @return mixed
     * @throws ErrorResponseException
     * @throws BadResponseException
     */
    public function get(string $endpoint, array $arguments = [])
    {
        $arguments = array_merge([
            'apiKey' => $this->getApiKey()
        ], $arguments);

        return $this->request('GET', $endpoint, [
            'query' => $arguments
        ]);
    }

    /**
     * POST method
     * @param string $endpoint
     * @param array $parameters
     * @return mixed
     * @throws ErrorResponseException
     * @throws BadResponseException
     */
    public function post(string $endpoint, array $parameters = [])
    {
        $parameters = array_merge([
            'apiKey' => $this->getApiKey()
        ], $parameters);

        return $this->request('POST', $endpoint, [
            'form_params' => $parameters
        ]);
    }

    /**
     * Execute request
     * @param string $method
     * @param string $endpoint
     * @param array $options
     * @return mixed
     * @throws ErrorResponseException
     */
    public function request(string $method, string $endpoint, array $options = [])
    {
        try {
            $response = $this->getClient()->request($method, $endpoint, $options);
            $object = $this->jsonToObject($response->getBody()->getContents());
            if ($object->status === 'error') {
                throw new ErrorResponseException($object->message);
            }
            return $object;
        } catch (ClientException $e) {
            throw new BadResponseException();
        }
    }
}
