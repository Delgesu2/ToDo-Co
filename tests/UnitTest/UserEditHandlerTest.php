<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 16/05/19
 * Time: 16:53
 */

namespace Tests\UnitTest;

use AppBundle\Entity\User;
use AppBundle\Form\Handler\UserEditHandler;
use AppBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserEditHandlerTest
 *
 * @package Tests\UnitTest
 */
class UserEditHandlerTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testEditUserHandleReturnFalse()
    {
        $flashBag = $this->createMock(FlashBagInterface::class);
        $userRepository = $this->createMock(UserRepository::class);
        $passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        $handler = new UserEditHandler($flashBag, $userRepository, $passwordEncoder);

        $form = $this->createMock(FormInterface::class);
        $user = new User();

        $this->assertFalse($handler->handle($form, $user));

    }

    /**
     * @throws \ReflectionException
     */
    public function testEditUserHandleReturnTrue()
    {
        $flashBag = new FlashBag();

        $userRepository = $this->createMock(UserRepository::class);
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        $handler = new UserEditHandler($flashBag, $userRepository, $userPasswordEncoder);

        $form = $this->createMock(FormInterface::class);
        $form->method("isSubmitted")->willReturn(true);
        $form->method("isValid")->willReturn(true);

        $user = new User();

        $this->assertTrue($handler->handle($form, $user));

        $this->assertContains("L'utilisateur a bien été modifié.", $flashBag->get("success"));

    }

}
