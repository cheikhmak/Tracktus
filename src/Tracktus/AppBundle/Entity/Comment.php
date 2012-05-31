<?php

namespace Tracktus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tracktus\AppBundle\Entity\User;
use Tracktus\AppBundle\Entity\Task;

/**
 * Comment on a task
 *
 * @author pierre
 * @ORM\Entity
 */
class Comment
{
    
    /**
     * The comment id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;
    
    /**
     * Text of the comment
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;
    
    /**
     * The User who post the comment
     * @var User
     * @ORM\ManyToOne(targetEntity="Tracktus\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * The task which is commented
     * @var Task
     * @ORM\ManyToOne(targetEntity="Tracktus\AppBundle\Entity\Task", inversedBy="comments")
     */
    private $task;


    public function __construct($text= null, User $author = null)
    {
        $this->setText($text);
        $this->setAuthor($author);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $text
     * @throws \InvalidArgumentException if $text is null or not a string
     */
    public function setText($text)
    {
        if (!is_string($text) && !is_null($text))
        {
            throw new \InvalidArgumentException('$text must be a string or null');
        }
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param User $user
     */
    public function setAuthor($user)
    {
        $this->author = $user;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \Tracktus\AppBundle\Entity\Task $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return \Tracktus\AppBundle\Entity\Task
     */
    public function getTask()
    {
        return $this->task;
    }
}
