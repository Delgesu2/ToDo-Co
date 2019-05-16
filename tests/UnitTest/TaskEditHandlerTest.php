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

        $handler = new TaskEditHandler($flashBag, $taskRepository);

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

        $handler = new TaskEditHandler($flashBag, $taskRepository);

        $form = $this->createMock(FormInterface::class);
        $form->method("isSubmitted")->willReturn(true);
        $form->method("isValid")->willReturn(true);

        $this->assertTrue($handler->handle($form));

        $this->assertContains('La tâche a bien été modifiée.', $flashBag->get("success"));

    }

}