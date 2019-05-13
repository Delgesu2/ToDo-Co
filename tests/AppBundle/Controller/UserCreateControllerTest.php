<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserCreateControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserCreate()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'Rachid';
        $form['user[password][first]'] = 'motdepasse';
        $form['user[password][second]'] = 'motdepasse';
        $form['user[email]'] = 'rachid@mail.com';
        $form['user[role]'] = 'ROLE_ADMIN';
        $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $this->client->followRedirects();
    }

}