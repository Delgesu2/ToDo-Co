<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 03/05/19
 * Time: 00:29
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskToggleControllerTest extends WebTestCase
{
    public function testTaskToggleDone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks/1/toggle');
        $client->followRedirect();

        $successMessage = 'Superbe ! La tâche 1 a bien été marquée comme faite.';
        $this->assertContains($successMessage, $crawler->filter('div.alert-success')->text());

    }

    public function testTaskToggleToDo()
    {
        $client = static::createClient();

    }
}