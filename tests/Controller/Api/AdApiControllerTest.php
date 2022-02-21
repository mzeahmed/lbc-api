<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdApiControllerTest extends WebTestCase
{
    public function testApiAdEndpointStatusCode()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/ad');

        $response = $client->getResponse();
        self::assertEquals(200, $response->getStatusCode());
    }
}
