<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 02/05/19
 * Time: 21:19
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskListControllerTest extends WebTestCase
{
    public function testTaskList()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/tasks',
            ['PHP_AUTH_USER' => 'Paul','PHP_AUTH_PW'   => 'tralala']
            );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString(
            'Tâches: liste complète ',
            $crawler->filter('h1')->text());
    }

}