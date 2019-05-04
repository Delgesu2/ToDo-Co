<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserEditControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserEdit()
    {
        $this->logIn();

        $crawler = $this->client->request(
            'POST',
            '/users/6/edit'
        );

        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]'] = 'Patrick';
        $form['password[first]'] = 'tralala';
        $form['password[second]'] = 'tralala';
        $form['user[email]'] = 'adresse@mail.com';
        $form['user_edit[roles]'] = 'ROLE_ADMIN';

        $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}