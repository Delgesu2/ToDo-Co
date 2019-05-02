<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 01/05/19
 * Time: 14:58
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserEditControllerTest extends WebTestCase
{
    public function testUserEdit()
    {
        $client = static::createClient([]);

        $crawler = $client->request(
            'GET',
            '/users/6/edit',
            ['PHP_AUTH_USER' => 'Paul','PHP_AUTH_PW' => 'tralala']
        );

        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]'] = 'Patrick';
        $form['password[first]'] = 'tralala';
        $form['password[second]'] = 'tralala';
        $form['user[email]'] = 'adresse@mail.com';
        $form['user_edit[roles]'] = 'ROLE_ADMIN';

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("L\'utilisateur a bien été modifié")')->count());
    }
}