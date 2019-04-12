<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 *
 * @package AppBundle\Fixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername('Utilisater' . $i);
            $user->setPassword('Password');
            $user->setEmail('adresse' . $i . '@mail.com');

            $manager->persist($user);
        }

        $manager->flush();
    }

}