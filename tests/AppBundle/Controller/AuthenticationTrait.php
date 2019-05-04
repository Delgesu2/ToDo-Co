<?php

namespace Tests\AppBundle\Controller;

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

        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken(
            'Xavier',
            'tralala',
            $firewallName,
            ['ROLE_ADMIN']
        );

        $session->set('_security_'.$firewallContext, serialize($token));

        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());

        $this->client->getCookieJar()->set($cookie);
    }

}