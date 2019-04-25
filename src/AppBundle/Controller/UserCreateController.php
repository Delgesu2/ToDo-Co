<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 17:21
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use AppBundle\Form\Handler\UserCreateHandler;
use AppBundle\Form\UserType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * @Route(
 *     path="/create",
 *     name="user_create",
 *     methods={"POST", "GET"}
 *     )
 */
class UserCreateController
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
     * @var UserCreateHandler
     */
    private $handler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * UserCreateController constructor.
     *
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param UserCreateHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment           $twig,
        FormFactoryInterface  $formFactory,
        UserCreateHandler     $handler,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig         = $twig;
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Request $request)
    {
        $user = new User();

        $form = $this->formFactory->create(UserType::class, $user)
            ->handleRequest($request);

        if ($this->handler->handle($form, $user)){
            return new RedirectResponse($this->urlGenerator->generate('homepage'));
        }

        return new Response(
            $this->twig->render('user/create.html.twig', [
                'form'=>$form->createView()
            ])
        );

    }
}