<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 16:02
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route(
 *     path="/tasks/{id}/toggle",
 *     name="task_toggle"
 *     )
 */
class TaskToggleController
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
     * TaskToggleController constructor.
     *
     * @param TaskRepository $repository
     * @param SessionInterface $session
     */
    public function __construct(
        TaskRepository        $repository,
        SessionInterface      $session
    )
    {
        $this->repository   = $repository;
        $this->session      = $session;
    }

    /**
     * @param Task $task
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(Task $task, Request $request)
    {
        $task->toggle(!$task->isDone());
        $this->repository->update();

        $this->session->getFlashBag()->add('success', sprintf('La tâche %s a bien été marquée comme faite.',
                                           $task->getTitle()));

        return new RedirectResponse($request->headers->get('referer'));

    }

}