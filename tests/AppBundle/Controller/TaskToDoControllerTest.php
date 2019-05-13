<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskToDoControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testTaskToDo()
    {
        $this->logIn();

        $crawler = $this->client->request('GET','/taskstodo');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());


        $this->assertStringContainsString(
            'à faire',
            $crawler->filter('h1')->text());

    }
}