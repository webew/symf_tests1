<?php

namespace App\Tests\Controller;

use App\Entity\Produit;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $client->followRedirects();

        $this->em = static::$container->get("doctrine")->getManager();//récupération de l'entity manager
        //outil de gestion de la bdd
        $schemaTool = new SchemaTool($this->em);
        //suppression de la bdd
        $schemaTool->dropDatabase();
        //création de la bdd
        static $metadata = null;
        if(! $metadata){
            $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        }
        $schemaTool->createSchema($metadata);
        //navigation vers l'url du formulaire
        $crawler = $client->request('GET', '/produit/new');
        //soumission du formulaire
        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form(['produit[name]'=>'tata']);
        $client->submit($form);

//        $em = static::$container->get("doctrine")->getManager();//récupération de l'entity manager
        //récupération des produits
        $produits = static::$container->get("doctrine")->getRepository(Produit::class)->findAll();//récupération de l'entity manager
//        dd($produits);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Produit index');
        $this->assertCount(1, $produits);
    }


}
