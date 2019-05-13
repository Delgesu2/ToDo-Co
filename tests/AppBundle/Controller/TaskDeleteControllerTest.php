<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskDeleteControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testTaskDelete()
    {
        $this->logIn();

        $this->client->request('GET', '/tasks/8/delete');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

    }
}