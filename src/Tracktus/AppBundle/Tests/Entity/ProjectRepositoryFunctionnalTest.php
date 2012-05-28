<?php

namespace Tracktus\AppBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Project Repository Tester
 *
 * @author pierre
 */
class ProjectRepositoryFunctionnalTest extends WebTestCase
{

    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     *
     * @var \Symfony\Component\DependencyInjection\Container
     */
    private $container;

    public function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->container = $kernel->getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        $this->application->setAutoExit(false);
        $this->runConsole("doctrine:fixtures:load");
    }

    protected function runConsole($command, Array $options = array())
    {
        $options = array_merge($options, array('command' =>$command));
        return $this->application->run(new ArrayInput($options),
            new NullOutput());
    }

    public function testProjectsOwnedBy()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUserName('fred');
        $projects = $this->em
            ->getRepository('Tracktus\AppBundle\Entity\Project')
            ->getProjectsOwnedBy($user);
        $this->assertNotEmpty($projects);
    }

}
