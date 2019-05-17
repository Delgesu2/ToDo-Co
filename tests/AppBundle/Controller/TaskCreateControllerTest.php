<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 01/05/19
 * Time: 21:10
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskCreateControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testTaskCreate()
    {
        $this->logIn();

        $crawler = $this->client->request('GET','/tasks/create');

        $form = $crawler->filter("form[name=task]")->form([
            'task[title]' => 'new task',
            'task[content]' => 'things to do'
        ]);

        $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $this->client->followRedirect();

    }

}