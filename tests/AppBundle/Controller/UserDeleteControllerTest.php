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
    use AuthenticationTrait;

    public function testUserDelete()
    {
        $this->logIn();

        $this->client->request('GET', "/users/12/delete");

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

}
