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
 * @package AppBundle\Repository
 *
 * @method Task[] findAll()
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
}