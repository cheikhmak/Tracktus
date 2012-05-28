<?php
namespace Tracktus\AppBundle\Tests\Entity;

use Tracktus\AppBundle\Entity\Task;
use Tracktus\UserBundle\Entity\User;
use Tracktus\AppBundle\Entity\Project;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Task
     */
    private $task;

    public function setUp()
    {
        $this->task = new Task('Do this!', 'You have to do this');
    }

    public function testName()
    {
        $this->assertEquals('Do this!', $this->task->getName());
        $this->task->setName('Do that!');
        $this->assertEquals('Do that!', $this->task->getName());
    }

    public function testDescription()
    {
        $this->assertEquals('You have to do this', $this->task->getDescription());
        $this->task->setDescription('You have to do that');
        $this->assertEquals('You have to do that', $this->task->getDescription());
    }

    public function testCreationDate()
    {
        $date = new \DateTime();
        $this->assertEquals($date->format('d/m/Y'), $this->task->createdAt()->format('d/m/Y'));
    }

    public function testOwner()
    {
        $user = new User();
        $this->task->setOwner($user);
        $this->assertEquals($user, $this->task->getOwner());
    }

    public function testProject()
    {
        $project = new Project();
        $this->task->setProject($project);
        $this->assertEquals($project, $this->task->getProject());
    }

    public function testState()
    {
        $this->assertEquals(false, $this->task->getState());
        $this->task->setState(true);
        $this->assertEquals(true, $this->task->getState());
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->task->getId());
    }

}
