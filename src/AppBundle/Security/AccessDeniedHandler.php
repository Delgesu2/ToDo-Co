<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 25/04/19
 * Time: 19:04
 */

namespace AppBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Twig\Environment;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AccessDeniedHandler constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     *
     * @return Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        return new Response(
            $this->twig->render('exception/403.html.twig'), 403);
    }

}