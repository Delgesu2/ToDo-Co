<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 23/04/19
 * Time: 18:42
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class TaskRepository
 *
 * @method Task[] findAll()
 *
 * @package AppBundle\Repository
 */
class TaskRepository extends ServiceEntityRepository
{
    /**
     * TaskRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @param Task $task
     */
    public function save(Task $task)
    {
        $this->_em->persist($task);
        $this->_em->flush();
    }

    /**
     * Update
     */
    public function update()
    {
        $this->_em->flush();
    }

    /**
     * @param $task
     */
    public function delete($task)
    {
        $this->_em->remove($task);
        $this->_em->flush();
    }
}