<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;

trait AuthenticationTrait
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    protected function logIn(string $role = "ROLE_USER")
    {
        $this->client = static::createClient();

        /** @var SessionInterface $session */
        $session = $this->client->getContainer()->get('session');

        /** @var EntityManagerInterface $em */
        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');

        $firewallName = 'main';
        $firewallContext = 'main';

        $this->user = $this->entityManager->getRepository(User::class)->findOneBy(["role" => $role]);

        $token = new UsernamePasswordToken(
            $this->user,
            '',
            $firewallName,
            $this->user->getRoles()
        );

        $session->set('_security_'.$firewallContext, serialize($token));

        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());

        $this->client->getCookieJar()->set($cookie);
    }

}
