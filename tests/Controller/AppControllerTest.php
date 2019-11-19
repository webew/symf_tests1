<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/app');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello');
    }
}
