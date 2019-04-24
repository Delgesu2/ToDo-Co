<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 15:17
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * TaskDeleteController constructor.
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
     *
     * @return RedirectResponse
     */
    public function __invoke(Task $task)
    {
        $this->repository->delete($task);

        $this->session->getFlashbag()->add('success', 'La tâche a bien été supprimée.');

        return new RedirectResponse($this->urlGenerator->generate('task_list'));
    }

}