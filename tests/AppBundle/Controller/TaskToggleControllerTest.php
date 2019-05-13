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

        $this->client->request('GET', '/tasks/5/toggle');

        $this->assertEquals('referer', $this->client->getResponse()->getStatusCode());
    }
}