<?php
namespace Avido\LaravelBricksetApiClient\Tests;
use Avido\LaravelBricksetApiClient\Exceptions\invalidCredentialsException;
use Avido\LaravelBricksetApiClient\Tests\TestCase;

class LaravelBricksetApiClientTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function loginSuccess()
    {
        $this->setMock('Common/loginSuccessResponse.json');
        $response = $this->client->login();
        $this->assertTrue($response);
    }

    /**
     * @test
     */
    public function loginFailed()
    {
        $this->expectException(invalidCredentialsException::class);
        $this->setMock('Common/loginFailedResponse.json');
        $this->client->login();
    }

    /**
     * @test
     */
    public function getKeyUsageStats()
    {
        $this->setMock('Common/keyUsageStatsResponse.json');
        $response = $this->client->getKeyUsageStats();
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
    }
}
