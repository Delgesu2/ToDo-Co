<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 17/05/19
 * Time: 21:05
 */

namespace Tests\UnitTest;

use AppBundle\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testTaskEntity()
    {
        $task = new Task();

        $time = new \DateTime('now');

        $task->setTitle('test_title');
        $task->setContent('test_content');
        $task->setAuthor('test_author');
        $task->setCreatedAt($time);

        $this->assertEquals('test_title', $task->getTitle());
        $this->assertEquals('test_content', $task->getContent());
        $this->assertEquals('test_author', $task->getAuthor());
        $this->assertEquals($time, $task->getCreatedAt());
    }

}
