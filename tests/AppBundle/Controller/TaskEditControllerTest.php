<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 02/05/19
 * Time: 18:49
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskEditControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testTaskEdit()
    {
        $this->logIn();

        $task = $this->entityManager->getRepository(Task::class)->findOneByAuthor($this->user);

        $crawler = $this->client->request('GET','/tasks/'.$task->getId().'/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'tâche changée encore';
        $form['task[content]'] = 'choses à faire';

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertStringContainsString(
            'Superbe ! La tâche a bien été modifiée.',
            $crawler->filter('div.alert-success')->text());
    }
}