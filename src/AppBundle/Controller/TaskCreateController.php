<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 23/04/19
 * Time: 20:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Handler\TaskTypeCreateHandler;
use AppBundle\Form\TaskType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * @Route(
 *     path="/tasks/create",
 *     name="task_create",
 *     methods={"GET", "POST"}
 *     )
 */
class TaskCreateController
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
     * @var TaskTypeCreateHandler
     */
    private $handler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * TaskCreateController constructor.
     *
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param TaskTypeCreateHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment           $twig,
        FormFactoryInterface  $formFactory,
        TaskTypeCreateHandler $handler,
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
        $task = new Task();

        $form = $this->formFactory->create(TaskType::class)
                                  ->handleRequest($request);

        if ($this->handler->handle($form, $task)){
            return new RedirectResponse($this->urlGenerator->generate('task_list'));
        }

        return new Response(
            $this->twig->render('task/create.html.twig', [
                'form'=>$form->createView()
            ])
        );

    }


}