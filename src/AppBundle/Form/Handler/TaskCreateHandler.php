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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TaskCreateHandler
{
    /**
     * @var SessionInterface
     */
    private $session;

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
     * @param SessionInterface $session
     * @param TaskRepository $repository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        SessionInterface      $session,
        TaskRepository        $repository,
        TokenStorageInterface $tokenStorage
    ) {
        $this->session      = $session;
        $this->repository   = $repository;
        $this->tokenStorage = $tokenStorage;
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

            $this->session->getFlashbag()->add('success', 'La tâche a été bien ajoutée.');

            return true;

        }

        return false;

    }

}