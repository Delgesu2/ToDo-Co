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
        $form['user[username]'] = 'Johann';
        $form['user[password][first]'] = 'motdepasse';
        $form['user[password][second]'] = 'motdepasse';
        $form['user[email]'] = 'johann@mail.com';
        $form['user[role]'] = 'ROLE_ADMIN';

        $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->followRedirects();
    }

}