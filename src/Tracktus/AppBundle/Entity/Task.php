<?php

namespace Tracktus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Tracktus\AppBundle\Entity\User;
use Tracktus\AppBundle\Entity\Project;
use Tracktus\AppBundle\Entity\Comment;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represent a task in the tracker
 * @ORM\Entity
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
     * @var User
     * @ORM\ManyToOne(targetEntity="Tracktus\AppBundle\Entity\User", inversedBy="tasks")
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
     * @ORM\OneToMany(targetEntity="Tracktus\AppBundle\Entity\Comment", mappedBy="task")
     */
    private $comments;

    /**
     * Creation date of the task
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * The project relative to the task
     * @var Project
     * @ORM\ManyToOne(targetEntity="Tracktus\AppBundle\Entity\Project", inversedBy="tasks")
     */
    private $project;

    /**
     * @param string|null $name The name of the project
     * @param string|null $description Description of the project
     */
    public function __construct($name = null, $description = null)
    {
        $this->labels = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->creationDate = new \DateTime();
        $this->name = $name;
        $this->description = $description;
        $this->state = false;
    }

    /**
     * Return the list of comments relative to the task
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add a new comment to the task
     * @param Comment $comment
     * @throws \DomainException If $comment is blank
     */
    public function addComment($comment)
    {
        if ($comment->getText() ==""||$comment->getText() === null)
        {
            throw new \DomainException('$comment cannot be blank');
        }

        $this->comments->add($comment);
    }

    /**
     * Remove a comment to the task
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Return the creation date of the task
     * @return \DateTime
     */
    public function createdAt()
    {
        return $this->creationDate;
    }

    /**
     * Set the description of the task
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Return the description of the task
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return the Id of the task
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the labels relative to task
     * @return ArrayCollection
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Add a label to the task
     * @param Label $label
     */
    public function addLabel(Label $label)
    {
        $this->labels->add($label);
    }

    /**
     * Remove a label associated to the task
     * @param Label $label
     */
    public function removeLabel(Label $label)
    {
        $this->labels->removeElement($label);
    }

    public function getNumberOfComments()
    {
        return count($this->getComments());
    }

    /**
     * Set the name of the task
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Return the name of the task
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the owner of the task
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get the owner of the task
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the project relative to the task
     * @param Project $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * Return the project relative to the task
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set the state of task
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Return the state of the task
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

}
