<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskDeleteControllerTest extends WebTestCase
{
    public function testTaskDelete()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/{id}/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}