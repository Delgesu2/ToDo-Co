<?php

namespace Tests\UnitTest;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

/**
 * Class UserTypeTest
 *
 * @package Tests\UnitTest
 */
class UserTypeTest extends TypeTestCase
{
    /**
     * @return array
     */
    protected function getExtensions()
    {
        $validator = Validation::createValidator();

        return [
            new ValidatorExtension($validator),
        ];
    }

    /**
     * @throws \ReflectionException
     */
    public function testUserForm()
    {
        $formData = [
            'username' => 'username test',
            'password' => 'password test',
            'email'    => 'email@test.com',
            'role'     => ['roletest']
        ];

        $userObjectToCompare = $this->createMock(User::class);

        $form = $this->factory->create(UserType::class, $userObjectToCompare);

        $newUser = $this->createMock(User::class);
        $newUser->setUsername('username test');
        $newUser->setPassword('password test');
        $newUser->setEmail('email@test.com');
        $newUser->setRole(['roletest']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        //$this->assertTrue($form->isValid());

        $this->assertEquals($userObjectToCompare, $newUser);

    }

}
