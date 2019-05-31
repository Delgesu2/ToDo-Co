<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskDeleteControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testTaskDelete()
    {
        $this->logIn();

        $task = $this->entityManager->getRepository(Task::class)->findOneByAuthor($this->user);

        $this->client->request(
            'GET',
            '/tasks/'.$task->getId().'/delete',
            [],
            [],
            ['HTTP_REFERER'=>'/tasks']
        );

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}