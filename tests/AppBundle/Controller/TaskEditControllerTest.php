<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 02/05/19
 * Time: 18:49
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskEditControllerTest extends WebTestCase
{
    public function testTaskEdit()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/tasks/6/edit',
            ['PHP_AUTH_USER' => 'Paul','PHP_AUTH_PW' => 'tralala']
        );

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'tâche changée';
        $form['task[content]'] = 'choses à faire';

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertStringContainsString(
            'Superbe ! La tâche a bien été modifiée.',
            $crawler->filter('div.alert-success')->text());
    }
}