<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 23/04/19
 * Time: 18:36
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * @Route(
 *     path="/tasks",
 *     name="task_list",
 *     methods={"GET"}
 * )
 */
class TaskListController
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
                    'tasks' => $this->repository->listQuery()
                ])
        );
    }

}