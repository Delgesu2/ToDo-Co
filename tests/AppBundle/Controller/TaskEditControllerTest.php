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
    use AuthenticationTrait;

    public function testTaskEdit()
    {
        $this->logIn();

        $crawler = $this->client->request('GET','/tasks/8/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'tâche changée';
        $form['task[content]'] = 'choses à faire';

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertStringContainsString(
            'Superbe ! La tâche a bien été modifiée.',
            $crawler->filter('div.alert-success')->text());
    }
}