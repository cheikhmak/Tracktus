<?php

namespace Tracktus\AppBundle\DataFixtures\ORM;

use Tracktus\AppBundle\Entity\Project;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Data fixtures for Projects
*/
class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
        $project1 = new Project("Foo Project", "Create a foo thing");
        $project2 = new Project("Bar Project", "Create a bar thing");

        $project1->setManager($this->getReference("projectLead"));
        $project2->setManager($this->getReference("projectLead"));

        $manager->persist($project1);
        $manager->persist($project2);

        $this->addReference('fooProject', $project1);
        $manager->flush();
	}

    public function getOrder()
    {
        return 3;
    }
}
