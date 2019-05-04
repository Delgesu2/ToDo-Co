<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserListControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserList()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/users');

        $this->assertEquals(500, $this->client->getResponse()->getStatusCode());
    }
}