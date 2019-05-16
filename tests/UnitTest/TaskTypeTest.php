<?php

namespace Tests\UnitTest;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Component\Form\Test\TypeTestCase;

class TaskTypeTest extends TypeTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testTaskForm()
    {
        $formData = [
            'title'   => 'title test',
            'content' => 'content test'
        ];

        $taskObjectToCompare = $this->createMock(Task::class);

        $form = $this->factory->create(TaskType::class, $taskObjectToCompare);

        $task = $this->createMock(Task::class);
        $task->setTitle('title test');
        $task->setContent('content test');

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());

        $this->assertEquals($taskObjectToCompare, $task);

    }

}
