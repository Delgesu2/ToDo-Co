<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 30/04/19
 * Time: 23:36
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserCreateControllerTest extends WebTestCase
{
    public function testUserCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'Jeremiah';
        $form['user[password][first]'] = 'motdepasse';
        $form['user[password][second]'] = 'motdepasse';
        $form['user[email]'] = 'courriel@mail.com';
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(0, $crawler->filter('div.alert.alert-success')->count());
    }

}