<?php

namespace Tracktus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tracktus\UserBundle\Entity\User;

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
     * @var Tracktus\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Tracktus\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;


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
}
