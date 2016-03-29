<?php

use Liip\FunctionalTestBundle\Test\WebTestCase;

class LinksControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    public function setup()
    {
        $this->client = static::createClient();
        $this->loadFixtures([]);
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadApiKeyData',
            'AppBundle\DataFixtures\ORM\LoadLinkData',
        ]);
    }

    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }

    public function testGetLink()
    {
        $testUrl = sprintf('%s%s', $this->getApiUrl(), '/link/test.json?apiKey=test-key');
        $this->client->request('GET', $testUrl, ['ACCEPT' => 'application/json']);

        $response = $this->client->getResponse();

        $this->assertJsonResponse($response, 200);
        $this->assertContains('"url":"http:\/\/google.be","code":"test","clicks":0}}', $response->getContent());
    }

    public function getApiUrl()
    {
        return 'http://purl.docker/api/v1';
    }
}