<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 15/05/19
 * Time: 23:45
 */

namespace Tests\UnitTest;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use AppBundle\Form\Handler\UserCreateHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserCreateHandlerTest
 *
 * @package Tests\UnitTest
 */
class UserCreateHandlerTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testCreateUserHandleReturnFalse()
    {
        $flashBag = $this->createMock(FlashBagInterface::class);
        $userRepository = $this->createMock(UserRepository::class);
        $passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        $handler = new UserCreateHandler($flashBag, $userRepository,$passwordEncoder);

        $form = $this->createMock(FormInterface::class);
        $user = new User();

        $this->assertFalse($handler->handle($form,$user));

    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateUserHandleReturnTrue()
    {
        $flashBag = new FlashBag();

        $userRepository = $this->createMock(UserRepository::class);
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        $handler = new UserCreateHandler($flashBag,$userRepository,$userPasswordEncoder);

        $form = $this->createMock(FormInterface::class);
        $form->method("isSubmitted")->willReturn(true);
        $form->method("isValid")->willReturn(true);

        $user = new User();

        $this->assertTrue($handler->handle($form, $user));

        $this->assertContains('L\'utilisateur a bien été ajouté.', $flashBag->get('success'));
    }
}
