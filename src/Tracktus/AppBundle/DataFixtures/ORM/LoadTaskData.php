<?php
namespace Tracktus\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tracktus\AppBundle\Entity\Task;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $task1 = new Task('Do that', 'You have to do that');
        $task1->setOwner($this->getReference('user'));
        $task1->setProject($this->getReference('fooProject'));

        $task2 = new Task('Do that', 'You have to do that');
        $task2->setProject($this->getReference('fooProject'));
        $task2->setOwner($this->getReference('user'));

        $task3 = new Task('Do this', 'You have to do this');
        $task3->setProject($this->getReference('fooProject'));
        $task3->setOwner($this->getReference('user'));

        $task4 = new Task('Do that', 'You have to do that');
        $task4->setProject($this->getReference('fooProject'));
        $task4->setOwner($this->getReference('projectLead'));

        $task5 = new Task('Do that', 'You have to do that');
        $task5->setProject($this->getReference('fooProject'));
        $task5->setOwner($this->getReference('projectLead'));

        $task6 = new Task('Do this', 'You have to do this');
        $task6->setProject($this->getReference('fooProject'));
        $task6->setOwner($this->getReference('projectLead'));

        $manager->persist($task1);
        $manager->persist($task2);
        $manager->persist($task3);
        $manager->persist($task4);
        $manager->persist($task5);
        $manager->persist($task6);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 4;
    }
}
