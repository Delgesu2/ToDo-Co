<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 17:23
 */

namespace AppBundle\Form\Handler;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateHandler
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserCreateHandler constructor.
     *
     * @param SessionInterface $session
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        SessionInterface             $session,
        UserRepository               $repository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->session         = $session;
        $this->repository      = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * @param FormInterface $form
     * @param User $user
     *
     * @return bool
     */
    public function handle(
        FormInterface $form,
        User          $user
    )
    {
        if ($form->isSubmitted() && $form->isValid()){

            $password = $this->passwordEncoder->encodePassword(
                                    $user, $user->getPassword());

            $user->setPassword($password);

            $this->repository->save($user);

            $this->session->getFLashbag()->add('access', "L'utilisateur a bien été ajouté.");

            return true;
        }

        return false;
    }

}