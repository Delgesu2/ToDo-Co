<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 15/05/19
 * Time: 21:58
 */

namespace Tests\UnitTest;

use AppBundle\Entity\Task;
use AppBundle\Form\Handler\TaskEditHandler;
use AppBundle\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class TaskEditHandlerTest
 *
 * @package Tests\UnitTest
 */
class TaskEditHandlerTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testEditTaskHandleReturnFalse()
    {
        $flashBag = $this->createMock(FlashBagInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        $tokenStorage = $this->createMock(TokenStorageInterface::class);

        $handler = new TaskEditHandler($flashBag, $taskRepository, $tokenStorage);

        $form = $this->createMock(FormInterface::class);
        $task = new Task();

        $this->assertFalse($handler->handle($form, $task));

    }

    /**
     * @throws \ReflectionException
     */
    public function testEditTaskHandleReturnTrue()
    {
        $flashBag = new FlashBag();

        $taskRepository = $this->createMock(TaskRepository::class);
        $tokenStorageInterface = $this->createMock(TokenStorageInterface::class);
        $tokenInterface = $this->createMock(TokenInterface::class);

        $handler = new TaskEditHandler($flashBag, $taskRepository, $tokenStorageInterface);

        $form = $this->createMock(FormInterface::class);
        $form->method("isSubmitted")->willReturn(true);
        $form->method("isValid")->willReturn(true);

        $task = new Task;

        $this->assertTrue($handler->handle($form, $task));

        $this->assertContains('La tâche a bien été modifiée.', $flashBag->get("success"));

    }

}