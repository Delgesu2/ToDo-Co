<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 14:06
 */

namespace AppBundle\Form\Handler;

use AppBundle\Repository\TaskRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TaskEditHandler
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
     * TaskEditHandler constructor.
     *
     * @param SessionInterface $session
     * @param TaskRepository $repository
     */
    public function __construct(
        SessionInterface $session,
        TaskRepository   $repository
    )
    {
        $this->session    = $session;
        $this->repository = $repository;
    }

    /**
     * @param FormInterface $form
     * 
     * @return bool
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()){

            $this->repository->update();

            $this->session->getFlashbag()->add('success', 'La tâche a bien été modifiée.');

            return true;
        }

        return false;
    }

}