<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AppBundle\Controller\AuthenticationTrait;

class UserEditControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testUserEdit()
    {
        $this->logIn("ROLE_ADMIN");

        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);

        $crawler = $this->client->request('GET','/users/'.$user->getId().'/edit');

        $form = $crawler->filter("form[name=user]")->form([
            "user[username]"         => "Pat",
            "user[password][first]"  => "motdepasse",
            "user[password][second]" => "motdepasse",
            "user[email]"            => "super@mail.com",
            "user[role]"             => "ROLE_ADMIN"
        ]);

        $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

}