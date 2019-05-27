<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 13:19
 */

namespace AppBundle\Controller;

use AppBundle\Security\TaskVoter;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Task;
use AppBundle\Form\Handler\TaskEditHandler;
use AppBundle\Form\TaskType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

/**
 * @Route(
 *     path="/tasks/{id}/edit",
 *     name="task_edit",
 *     methods={"GET", "POST"}
 *     )
 */
class TaskEditController
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
     * @var TaskEditHandler
     */
    private $handler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * TaskEditController constructor.
     *
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param TaskEditHandler $handler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment           $twig,
        FormFactoryInterface  $formFactory,
        TaskEditHandler       $handler,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->twig         = $twig;
        $this->formFactory  = $formFactory;
        $this->handler      = $handler;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Request $request
     * @param Security $security
     *
     * @return RedirectResponse|Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(
        Request $request,
        Task    $task
    )
    {
        $form = $this->formFactory->create(TaskType::class, $task)
            ->handleRequest($request);

        if ($this->handler->handle($form, $task)) {

            return new RedirectResponse(
                $this->urlGenerator->generate('task_list')
            );
        }

        return new Response(
            $this->twig->render('task/edit.html.twig', [
                'form' => $form->createView(),
                'task' => $task
            ])
        );
    }

}