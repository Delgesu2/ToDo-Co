<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 28/04/19
 * Time: 00:04
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route(
 *     path="/users/{id}/delete",
 *     name="user_delete"
 *     )
 */
class UserDeleteController
{
    /**
     * @var UserRepository
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


    public function __construct(
        UserRepository   $repository,
        SessionInterface $session,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->repository   = $repository;
        $this->session      = $session;
        $this->urlGenerator = $urlGenerator;
    }


    public function __invoke(User $user)
    {
        $this->repository->delete($user);

        $this->session->getFlashbag()->add('Success', 'Le compte de l\'utilisateur a bien été supprimé.');

        return new  RedirectResponse(
            $this->urlGenerator->generate('user_list')
        );
    }

}