<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 01/05/19
 * Time: 21:10
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskCreateControllerTest extends WebTestCase
{
    public function testTaskCreate()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/tasks/create',
            ['PHP_AUTH_USER' => 'Paul', 'PHP_AUTH_PW'=> 'tralala']
        );

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'new task';
        $form['task[content]'] = 'things to do';

        $client->submit($form);

        $this->assertSame(1,$crawler->filter('La tâche a été bien été ajoutée.'));

        $client->followRedirect();


    }

}