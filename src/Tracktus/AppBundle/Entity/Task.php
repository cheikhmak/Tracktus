<?php

namespace Tracktus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represent a task in the tracker
 * @ORM\Entity()
 */
class Task
{
    /**
     * The task id
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * The name of the task
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Description of the task
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * State of the task (started, finished, accepted)
     * @var string
     * @ORM\Column(type="text")
     * @Assert\Choice(choices={"task.started", "task.finished", "task.accepted"})
     */
    private $state;

    /**
     * The user in charge of the task
     * @var Tracktus\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Tracktus\UserBundle\Entity\User", inversedBy="tasks")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * Labels which define the task
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tracktus\AppBundle\Entity\Label")
     * @ORM\JoinTable(name="tasks_labels",
     *     joinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="label_id", referencedColumnName="id")})
     */
    private $labels;

    /**
     * Comments on the task
     * @var ArrayCollection
     */
    private $comments;

    /**
     * Creation date of the task
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * The project relative to the task
     * @var Tracktus\AppBundle\Project
     */
    private $project;

    public function __construct()
    {
        $this->labels = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

}
