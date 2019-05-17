<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 17/05/19
 * Time: 20:27
 */

namespace Tests\UnitTest;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserEntity()
    {
        $user = new User();

        $user->setUsername('testname');
        $user->setPassword('password');
        $user->setEmail('test@email.com');
        $user->setRole('ROLE_ADMIN');

        $this->assertEquals('testname', $user->getUsername());
        $this->assertEquals('password', $user->getPassword());
        $this->assertEquals('test@email.com', $user->getEmail());
        $this->assertEquals('ROLE_ADMIN', $user->getRole());

    }

}
