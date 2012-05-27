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
    private $user;
}
