<?php
namespace Avido\LaravelBricksetApiClient\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $mockHandler;
    public $client;
    protected $defaultResponseHeader = [
        'Content-Type' => [
            'application/json; charset=utf-8'
        ]
    ];

    /**
     * Get Mockfile
     * @param string $type
     * @return string|null
     * @throws \Exception
     */
    public function getMockfile(string $type): ?string
    {
        $file = __DIR__ . "/Mocks/{$type}";
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        throw new \Exception("Mockfile not found '{$type}'");
    }

    /**
     * Set Mock Response
     * @param string $type - mockfile
     * @param int $httpCode
     * @throws \Exception
     */
    public function setMock(string $type, $httpCode = 200)
    {
        // setup mock for client.
        $this->mockHandler = new MockHandler();
        // load client
        $this->client = new BricksetApiClient('someApiKey', 'someUser', 'somePassword');
        $this->client->setClient(new Client([
            'handler' => $this->mockHandler
        ]));

        $this->mockHandler->append(new Response(
            $httpCode,
            $this->defaultResponseHeader,
            $this->getMockfile($type)
        ));
    }
}
