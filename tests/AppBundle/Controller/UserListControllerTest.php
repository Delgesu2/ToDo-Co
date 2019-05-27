<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AppBundle\Controller\AuthenticationTrait;

class UserListControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserList()
    {
        $this->logIn("ROLE_ADMIN");

        $this->client->request('GET', '/users');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}