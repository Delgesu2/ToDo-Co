<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 26/04/19
 * Time: 23:47
 */

namespace AppBundle\Security;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TaskVoter extends Voter
{
    const DEL = 'delete';

    /**
     * @param $attribute
     * @param $subject
     *
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, [self::DEL])){
            return false;
        }

        if(!$subject instanceof Task){
            return false;
        }

        return true;
    }

    /**
     * @param $attribute
     * @param $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if(!$user instanceof User){
            return false;
        }

        /** @var  Task $task */
        $task = $subject;

        switch ($attribute) {
            case self::DEL:
                return $this->canDelete($task, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    /**
     * @param Task $task
     * @param User $user
     *
     * @return bool
     */
    private function canDelete(Task $task, User $user)
    {
        if($user === $task->getAuthor() or $task->getAuthor() === null and $user->getRole() === 'ROLE_ADMIN'){
            return true;
        }
    }

}