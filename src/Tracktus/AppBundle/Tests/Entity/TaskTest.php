<?php
namespace Tracktus\AppBundle\Tests\Entity;

use Tracktus\AppBundle\Entity\Task;
use Tracktus\UserBundle\Entity\User;
use Tracktus\AppBundle\Entity\Project;
use Tracktus\AppBundle\Entity\Label;
use Tracktus\AppBundle\Entity\Comment;

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
        $this->assertEquals(false,$this->task->getState());
        $this->task->setState(true);
        $this->assertEquals(true, $this->task->getState());
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->task->getId());
    }

    public function testAddLabel()
    {
        $this->assertCount(0, $this->task->getLabels());
        $label = new Label('routine');
        $this->task->addLabel($label);
        $this->assertContains($label, $this->task->getLabels());
        $this->assertCount(1, $this->task->getLabels());
        $label2 = new Label('security');
        $label3 = new Label('optimization');
        $this->task->addLabel($label2);
        $this->assertCount(2, $this->task->getLabels());
        $this->assertNotContains($label3, $this->task->getLabels());
    }

    public function testRemovingALabel()
    {
        $label1 = new Label('security');
        $label2 = new Label('optimization');
        $this->task->addLabel($label1);
        $this->task->addLabel($label2);

        $this->task->removeLabel($label1);
        $this->assertCount(1, $this->task->getLabels());
        $this->assertNotContains($label1, $this->task->getLabels());
        $this->assertContainsOnly($label2, $this->task->getLabels());
    }

    public function testCannotAddABlankComment()
    {
        $comment = new Comment();
        $this->setExpectedException('\DomainException');
        $this->task->addComment($comment);
    }

    public function testNumberOfCommentRetrievedMustBeTheNumberOfCommentsAddedMinusCommentRemoved()
    {
        $comment1 = new Comment('Yeah!!! It rocks');
        $comment2 = new Comment('Bof');
        $comment3 = new Comment('Really good');
        $this->task->addComment($comment1);
        $this->task->addComment($comment2);
        $this->task->addComment($comment3);
        $this->assertEquals(3, $this->task->getNumberOfComments());
        $this->task->removeComment($comment2);
        $this->assertEquals(2, $this->task->getNumberOfComments());
    }

}
