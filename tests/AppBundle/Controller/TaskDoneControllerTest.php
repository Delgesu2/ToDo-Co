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
    use AuthenticationTrait;

    public function testTaskDone()
    {
        $this->logIn();

        $crawler = $this->client->request('GET','/tasksdone');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("déjà faites")')->count());
    }

}