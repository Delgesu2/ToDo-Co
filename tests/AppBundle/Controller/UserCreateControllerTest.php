<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserCreateControllerTest extends WebTestCase
{
    public function testUserCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'Xavier';
        $form['user[password][first]'] = 'motdepasse';
        $form['user[password][second]'] = 'motdepasse';
        $form['user[email]'] = 'troc@mail.com';
        $form['user[role]'] = 'ROLE_ADMIN';
        $client->submit($form);

        $client->followRedirects();

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

}