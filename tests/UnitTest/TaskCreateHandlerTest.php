<?php

namespace Tests\UnitTests\AppBundle\Form\Handler;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use AppBundle\Form\Handler\TaskCreateHandler;
use AppBundle\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class TaskCreateHandlerTest
 * @package Tests\UnitTests\AppBundle\Form\Handler
 */
class TaskCreateHandlerTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testHandleReturnFalse()
    {
        $flashBag = $this->createMock(FlashBagInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        $tokenStorage = $this->createMock(TokenStorageInterface::class);

        $handler = new TaskCreateHandler($flashBag, $taskRepository, $tokenStorage);

        $form = $this->createMock(FormInterface::class);
        $task = new Task();

        $this->assertFalse($handler->handle($form, $task));
    }

    /**
     * @throws \ReflectionException
     */
    public function testHandleReturnTrue()
    {
        $flashBag = new FlashBag();

        $taskRepository = $this->createMock(TaskRepository::class);
        $token = $this->createMock(TokenInterface::class);
        $tokenStorage = $this->createMock(TokenStorageInterface::class);

        $user = new User();

        $token->method("getUser")->willReturn($user);
        $tokenStorage->method("getToken")->willReturn($token);

        $handler = new TaskCreateHandler($flashBag, $taskRepository, $tokenStorage);

        $form = $this->createMock(FormInterface::class);
        $form->method("isSubmitted")->willReturn(true);
        $form->method("isValid")->willReturn(true);

        $task = new Task();

        $this->assertTrue($handler->handle($form, $task));

        $this->assertEquals($user, $task->getAuthor());

        $this->assertContains('La tâche a bien été ajoutée.', $flashBag->get("success"));
    }
}