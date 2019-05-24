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
    use AuthenticationTrait;
    
    public function testTaskToggle()
    {
        $this->logIn();

        $this->client->request(
            'GET',
            '/tasks/5/toggle',
            [],
            [],
            ['HTTP_REFERER'=>'/tasks']
        );

        $this->assertEquals('302', $this->client->getResponse()->getStatusCode());
    }
}