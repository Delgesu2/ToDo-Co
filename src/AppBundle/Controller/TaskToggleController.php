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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * TaskToggleController constructor.
     *
     * @param TaskRepository $repository
     * @param SessionInterface $session
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        TaskRepository        $repository,
        SessionInterface      $session,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->repository   = $repository;
        $this->session      = $session;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Task $task
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(Task $task)
    {
        $task->toggle(!$task->isDone());
        $this->repository->update();

        $this->session->getFlashBag()->add('success', sprintf('La tâche %s a bien été marquée comme faite.',
                                           $task->getTitle()));


        return new RedirectResponse(
            $this->urlGenerator->generate('task_list')
        );

    }

}