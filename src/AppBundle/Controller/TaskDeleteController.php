<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use AppBundle\Security\TaskVoter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

/**
 * @Route(
 *     path="/tasks/{id}/delete",
 *     name="task_delete"
 *     )
 */
class TaskDeleteController
{
    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * TaskDeleteController constructor.
     *
     * @param TaskRepository $repository
     * @param SessionInterface $session
     */
    public function __construct(
        TaskRepository        $repository,
        SessionInterface      $session
    ) {
        $this->repository   = $repository;
        $this->session      = $session;
    }

    /**
     * @param Task $task
     * @param Security $security
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function __invoke(
        Task     $task,
        Security $security,
        Request  $request
)
    {
        if($security->isGranted(TaskVoter::DEL, $task) === true) {

            $this->repository->delete($task);

            $this->session->getFlashbag()->add('success', 'La tâche a bien été supprimée.');

            return new RedirectResponse($request->headers->get('referer'));
        }

        return new Response('Suppression de la tâche non autorisée', 403);
    }

}