<?php

namespace Tracktus\AppBundle\Tests\Entity;

use Tracktus\AppBundle\Entity\Project;
use Tracktus\AppBundle\Entity\User;

class ProjectTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Project
     */
    private $project;

    public function setUp() {
        $this->project = new Project('Projet 1', 'Test project');
    }

    public function testGetters() {
        $this->assertEquals('Projet 1', $this->project->getName());
        $this->assertEquals('Test project', $this->project->getDescription());
        $date = new \DateTime();
        $presentDay = $date->format('d/m/Y');
        $this->assertEquals($presentDay, $this->project->createdAt()->format('d/m/Y'));
        $this->assertEquals(null, $this->project->getId());
    }

    public function testGenericSetter()
    {
        $this->project->setName('Projet 2');
        $this->project->setDescription('Test Project 2');
        $this->assertEquals('Projet 2', $this->project->getName());
        $this->assertEquals('Test Project 2', $this->project->getDescription());
    }

    public function testManager()
    {
        $user = new User();
        $this->project->setManager($user);
        $this->assertEquals($user, $this->project->getManager());
    }

    public function testCreator()
    {
        $user = new User();
        $this->project->setCreator($user);
        $this->assertEquals($user, $this->project->getCreator());
    }

    public function testAddMember()
    {
        $user = new User();
        $this->project->addMember($user);
        $members = $this->project->getMembers();
        $this->assertContains($user, $members);
        $this->assertCount(1, $members);
    }

    public function testIsMember()
    {
        $member = new User();
        $notAMember = new User();
        $this->project->addMember($member);
        $this->assertTrue($this->project->isMember($member));
        $this->assertFalse($this->project->isMember($notAMember));
    }

    public function testIsFinished()
    {
        $this->project->setFinished(true);
        $this->assertTrue($this->project->isFinished());
    }

    public function testSetFinishedThrowsExceptionOnNotBoolVariable()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->project->setFinished("dfghjk");
    }

    public function testStartDate()
    {
        $date = new \DateTime('now');
        $this->project->setStartDate($date);
        $this->assertEquals($date, $this->project->getStartDate());
    }

    public function testRemoveMember()
    {
        $user1 = new User();
        $user2 = new User();
        $this->project->addMember($user1);
        $this->project->addMember($user2);
        $this->assertCount(2, $this->project->getMembers());
        $this->project->removeMember($user1);
        $this->assertCount(1, $this->project->getMembers());
        $this->assertNotContains($user1, $this->project->getMembers());
        $this->assertContainsOnly($user2, $this->project->getMembers());
    }
}