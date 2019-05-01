<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 01/05/19
 * Time: 20:06
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserListControllerTest extends WebTestCase
{
    public function testUserList()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Paul',
            'PHP_AUTH_PW'   => 'tralala'
        ]);

        $crawler = $client->request('GET', '/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString(
            'assertStringContainsString',
            $crawler->filter('h1')->text()
        );
    }
}