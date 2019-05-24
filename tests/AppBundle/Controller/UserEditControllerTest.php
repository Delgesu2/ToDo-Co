<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AppBundle\Controller\AuthenticationTrait;

class UserEditControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserEdit()
    {
        $this->logIn();

        $crawler = $this->client->request('GET','/users/10/edit');

        $form = $crawler->filter("form[name=user]")->form([
            "user[username]"         => "Pat",
            "user[password][first]"  => "motdepasse",
            "user[password][second]" => "motdepasse",
            "user[email]"            => "super@mail.com",
            "user[role]"             => "ROLE_ADMIN"
        ]);

        $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}