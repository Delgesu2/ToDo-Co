<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 17:03
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * @Route(
 *     path="/users",
 *     name="user_list",
 *     methods={"GET"}
 *     )
 */
class UserListController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * UserListController constructor.
     *
     * @param UserRepository $repository
     * @param Environment $twig
     */
    public function __construct(
        UserRepository $repository,
        Environment    $twig)
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
                'user/list.html.twig', [
                    'users' => $this->repository->findAll()
                ])
        );
    }
}