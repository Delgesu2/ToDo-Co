<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskToDoControllerTest extends WebTestCase
{
    public function testTaskToDo()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/taskstodo',
            ['PHP_AUTH_USER' => 'Paul','PHP_AUTH_PW'   => 'tralala']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString(
            'Tâches: à faire',
            $crawler->filter('h1')->text());
    }
}