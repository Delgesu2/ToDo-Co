<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 24/04/19
 * Time: 18:27
 */

namespace AppBundle\Form\Handler;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEditHandler
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserEditHandler constructor.
     *
     * @param FlashBagInterface $flashBag
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        FlashBagInterface            $flashBag,
        UserRepository               $repository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->flashBag        = $flashBag;
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

            $this->repository->update();

            $this->flashBag->add('success', "L'utilisateur a bien été modifié.");

            return true;
        }
        return false;
    }

}