<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 23/04/19
 * Time: 21:16
 */

namespace AppBundle\Form\Handler;


use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TaskCreateHandler
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
     * TaskCreateHandler constructor.
     *
     * @param FlashBagInterface $flashBag
     * @param TaskRepository $repository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        FlashBagInterface     $flashBag,
        TaskRepository        $repository,
        TokenStorageInterface $tokenStorage
    ) {
        $this->flashBag = $flashBag;
        $this->repository        = $repository;
        $this->tokenStorage      = $tokenStorage;
    }


    /**
     * @param FormInterface $form
     * @param Task $task
     *
     * @return bool
     */
    public function handle(
        FormInterface $form,
        Task $task
    )
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $task->setAuthor($this->tokenStorage->getToken()->getUser());

            $this->repository->save($task);

            $this->flashBag->add('success', 'La tâche a bien été ajoutée.');

            return true;

        }

        return false;

    }

}