<?php
namespace Avido\LaravelBricksetApiClient\Tests;
use Avido\LaravelBricksetApiClient\Exceptions\invalidCredentialsException;
use Avido\LaravelBricksetApiClient\Tests\TestCase;

class SetsTest extends TestCase
{
    /**
     * @test
     */
    public function getSetsSuccess()
    {
        $this->setMock('Sets/getSetsSuccessResponse.json');
        $response = $this->client->getSets([
            'year' => 2020
        ]);
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->sets[0]->setID === 29830);
    }

    /**
     * @test
     */
    public function getAdditionalImagesSuccess()
    {
        $this->setMock('Sets/getAdditionalImagesSuccessResponse.json');
        $response = $this->client->getAdditionalImages(29830);
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->additionalImages[0]->thumbnailURL === 'https://images.brickset.com/sets/AdditionalImages/10270-1/tn_10270_1to1_jpg.jpg');
    }

    /**
     * @test
     */
    public function getInstructionsSuccess()
    {
        $this->setMock('Sets/getInstructionsSuccessResponse.json');
        $response = $this->client->getInstructions(29830);
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->instructions[0]->URL === 'https://www.lego.com/biassets/bi/6313846.pdf');
    }

    /**
     * @test
     */
    public function getThemesSuccess()
    {
        $this->setMock('Sets/getThemesSuccessResponse.json');
        $response = $this->client->getThemes();
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->themes[0]->theme === '4 Juniors');
    }

    /**
     * @test
     */
    public function getSubthemesSuccess()
    {
        $this->setMock('Sets/getSubthemesSuccessResponse.json');
        $response = $this->client->getSubthemes('Adventure');
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->subthemes[0]->theme === 'Adventurers');
    }

    /**
     * @test
     */
    public function getYearsSuccess()
    {
        $this->setMock('Sets/getYearsSuccessResponse.json');
        $response = $this->client->getSubthemes('Adventure');
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->years[0]->year === '2020');
    }

    /**
     * @test
     */
    public function setCollectionSuccess()
    {
        $this->setMock('Sets/setCollectionSuccessResponse.json');
        $response = $this->client->setCollection(29830, [
            'own' => 1
        ]);
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('status', $response);
        $this->assertTrue($response->status === 'success');
    }

    /**
     * @test
     */
    public function getUserNotesSuccess()
    {
        $this->setMock('Sets/getUserNotesSuccessResponse.json');
        $response = $this->client->getUserNotes();
        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('matches', $response);
        $this->assertTrue($response->userNotes[0]->notes === 'note');
    }
}
