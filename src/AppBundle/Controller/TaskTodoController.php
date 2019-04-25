<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * @Route(
 *     path="/taskstodo",
 *     name="tasks_todo",
 *     methods={"GET"}
 * )
 */
class TaskTodoController
{
    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * TaskListController constructor.
     *
     * @param TaskRepository $repository
     * @param Environment $twig
     */
    public function __construct(
        TaskRepository $repository,
        Environment    $twig
    )
    {
        $this->repository = $repository;
        $this->twig       = $twig;
    }

    /**
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke()
    {
        return new Response(
            $this->twig->render(
                'task/list.html.twig',[
                    'tasks' => $this->repository->findBy(
                        ['isDone'    => 0],
                        ['createdAt' => 'ASC']
                )
            ])
        );
    }

}