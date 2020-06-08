<?php
namespace Avido\LaravelBricksetApiClient\Tests;
use Avido\LaravelBricksetApiClient\Exceptions\invalidCredentialsException;
use Avido\LaravelBricksetApiClient\Tests\TestCase;

class MinifigsTest extends TestCase
{
    /**
     * @test
     */
    public function getMinifigCollectionSuccess()
    {
        $this->setMock('Minifigs/getMinifigsCollectionSuccessResponse.json');
        $response = $this->client->getMinifigCollection([
            'owned' => 1
        ]);
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->minifigs[0]->minifigNumber === 'adv001');
    }

    /**
     * @test
     */
    public function setMinifigCollectionSuccess()
    {
        $this->setMock('Minifigs/setMinifigsCollectionSuccessResponse.json');
        $response = $this->client->setMinifigCollection('adv001', [
            'own' => 1
        ]);
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('status', $response);
        $this->assertTrue($response->status === 'success');
    }
}

