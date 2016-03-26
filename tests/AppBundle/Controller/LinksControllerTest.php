<?php


use Liip\FunctionalTestBundle\Test\WebTestCase;

class LinksControllerTest extends WebTestCase
{
    public function setup()
    {
        $this->client = static::createClient();
    }

    public function testGetLink()
    {
        $crawler = $this->client->request('GET', '/api/v1/link/1');
        dump($crawler);
    }
}