<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 14:06
 */

namespace AppBundle\Form\Handler;

use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Csrf\TokenStorage\ClearableTokenStorageInterface;

class TaskEditHandler
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * TaskEditHandler constructor.
     *
     * @param FlashBagInterface $flashBag
     * @param TaskRepository $repository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        FlashBagInterface $flashBag,
        TaskRepository    $repository,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->flashBag   = $flashBag;
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param FormInterface $form
     * @param Task $task
     *
     * @return bool
     */
    public function handle(FormInterface $form, Task $task)
    {
        if ($form->isSubmitted() && $form->isValid()){

            // If anonymous task
            if (is_null($task->getAuthor())) {
                $task->setAuthor($this->tokenStorage->getToken()->getUser());
            }

            $this->repository->update();

            $this->flashBag->add('success', 'La tâche a bien été modifiée.');

            return true;
        }

        return false;
    }

}