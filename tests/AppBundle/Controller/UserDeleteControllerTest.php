<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 01/05/19
 * Time: 19:30
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserDeleteControllerTest extends WebTestCase
{
    public function testUserDelete()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Paul',
            'PHP_AUTH_PW'   => 'tralala'
        ]);

        $client->request('GET', '/users/6/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}