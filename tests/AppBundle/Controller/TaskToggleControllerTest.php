<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 03/05/19
 * Time: 00:29
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskToggleControllerTest extends WebTestCase
{
    use AuthenticationTrait;
    
    public function testTaskToggle()
    {
        $this->logIn();

        $task = $this->entityManager->getRepository(Task::class)->findOneByAuthor($this->user);

        $this->client->request(
            'GET',
            '/tasks/'.$task->getId().'/toggle',
            [],
            [],
            ['HTTP_REFERER'=>'/tasks']
        );

        $this->assertEquals('302', $this->client->getResponse()->getStatusCode());
    }
}