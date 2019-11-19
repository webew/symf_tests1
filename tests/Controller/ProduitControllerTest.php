<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/produit/new');
        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form(['produit[name]'=>'toto']);
        $client->submit($form);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Produit index');
        $this->assertSelectorTextContains('td', 'toto');
    }
}
