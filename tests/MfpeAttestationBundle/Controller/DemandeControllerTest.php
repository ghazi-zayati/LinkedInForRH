<?php

namespace Prototype\AttestationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of DemandeController

 */
class DemandeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
