<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 18:25
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use AppBundle\Form\Handler\UserEditHandler;
use AppBundle\Form\UserType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * @Route(
 *     path="/users/{id}/edit",
 *     name="user_edit",
 *     methods={"GET", "POST"}
 *     )
 */
class UserEditController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UserEditHandler
     */
    private $handler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * UserEditController constructor.
     *
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param UserEditHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment           $twig,
        FormFactoryInterface  $formFactory,
        UserEditHandler       $handler,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig         = $twig;
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Request $request
     * @param User $user
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(
        Request $request,
        User    $user
    )
    {
        $form = $this->formFactory->create(UserType::class, $user)
            ->handleRequest($request);

        if ($this->handler->handle($form, $user)){

            return new RedirectResponse(
                $this->urlGenerator->generate('user_list')
            );
        }

        return new Response(
            $this->twig->render('user/edit.html.twig', [
                'form' => $form->createView(),
                'user' => $user
            ])
        );

    }

}