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
    use AuthenticationTrait;

    public function testTaskList()
    {
        $this->logIn();

        $crawler = $this->client->request('GET','/tasks');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());


        $this->assertStringContainsString(
            'liste complète',
            $crawler->filter('h1')->text());

    }

}