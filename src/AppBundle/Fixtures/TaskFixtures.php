<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TaskFixtures
 *
 * @package AppBundle\Fixtures
 */
class TaskFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $task = new Task();
            $task->setContent('Du contenu intéressant' . $i);
            $task->setTitle('Titre' . $i);

            $manager->persist($task);
        }

        $manager->flush();
    }

}