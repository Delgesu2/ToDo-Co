<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 17/05/19
 * Time: 22:10
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testLogin()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/login');
        static::assertEquals(200, $this->client->getResponse()->getStatusCode());
        static::assertSame(1, $crawler->filter('html:contains("Nom d\'utilisateur")')->count());
        static::assertSame(1, $crawler->filter('html:contains("Mot de passe")')->count());
    }

}
