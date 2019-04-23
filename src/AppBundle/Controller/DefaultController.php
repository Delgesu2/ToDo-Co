<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * @Route(
 *     path="/",
 *     name="homepage",
 *     methods={"GET"}
 * )
 */
class DefaultController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * DefaultController constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
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
            $this->twig->render('default/index.html.twig')
        );
    }
}
