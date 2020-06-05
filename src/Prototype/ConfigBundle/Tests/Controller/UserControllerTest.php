<?php

namespace Prototype\ConfigBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testGetalluser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getAllUser');
    }

    public function testGetuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getUser');
    }

    public function testPostuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postUser');
    }

    public function testPutuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/putUser');
    }

    public function testDeleteuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteUser');
    }

    public function testPostaffectrole()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postAffectRole');
    }
}
