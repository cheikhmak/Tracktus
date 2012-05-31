<?php
namespace Tracktus\AppBundle\Tests\Entity;
use Tracktus\AppBundle\Entity\Comment;
use Tracktus\AppBundle\Entity\User;

class CommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Comment
     */
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment('Yeah it\'s a  comment!');
    }

    public function assertPreConditions()
    {
        $this->assertEquals('Yeah it\'s a  comment!', $this->comment->getText());
        $this->assertNull($this->comment->getId());
    }

    public function testRetrievingUser()
    {
        $user = new User();
        $this->comment->setAuthor($user);
        $this->assertEquals($user, $this->comment->getAuthor());
    }

    public function testCreatingCommentWithoutParameterReturnNullTextAndNullAuthor()
    {
        $comment = new Comment();
        $this->assertNull($comment->getText());
        $this->assertNull($comment->getAuthor());
    }

    public function testDescriptionMustBeAStringOrNull()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->comment->setText(23);
        $this->setExpectedException('\InvalidArgumentException');
        $this->comment->setText(true);
    }
}
