<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 03/05/19
 * Time: 00:17
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskDoneControllerTest extends WebTestCase
{
    public function testTaskDone()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/tasksdone',
            ['PHP_AUTH_USER' => 'Paul','PHP_AUTH_PW'   => 'tralala']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString(
            'Tâches: déjà faites',
            $crawler->filter('h1')->text());
    }

}