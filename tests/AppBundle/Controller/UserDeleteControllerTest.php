<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 01/05/19
 * Time: 19:30
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserDeleteControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserDelete()
    {
        $this->logIn("ROLE_ADMIN");

        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);

        $this->client->request('GET', "/users/".$user->getId()."/delete");

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

}
