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

    protected function logIn()
    {
        $this->client = static::createClient();

        /** @var SessionInterface $session */
        $session = $this->client->getContainer()->get('session');

        /** @var EntityManagerInterface $em */
        $em = $this->client->getContainer()->get('doctrine.orm.entity_manager');

        $firewallName = 'main';
        $firewallContext = 'main';

        $user = $em->getRepository(User::class)->findOneBy([]);

        $token = new UsernamePasswordToken(
            $user,
            '',
            $firewallName,
            $user->getRoles()
        );

        $session->set('_security_'.$firewallContext, serialize($token));

        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());

        $this->client->getCookieJar()->set($cookie);
    }

}
