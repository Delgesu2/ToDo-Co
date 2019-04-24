<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 17:04
 */

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class UserRepository
 *
 * @method User[] findAll()
 *
 * @package AppBundle\Repository
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Update
     */
    public function update()
    {
        $this->_em->flush();
    }
}