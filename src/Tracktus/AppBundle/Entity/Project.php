<?php

namespace Tracktus\AppBundle\Entity;

use Tracktus\AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Tracktus\AppBundle\Entity\Task;

/**
 * @ORM\Entity(repositoryClass="Tracktus\AppBundle\Entity\Repository\ProjectRepository")
 * Represents a project in the tracker
 */
class Project {

    /**
    * Id of the project
    * @var int
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    private $id;
    
    
    /**
     * Name of the project
     * @var string
     * @ORM\Column(type="string", unique="true")
     */
    private $name;

    /**
     * Description of the project
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * Creation date of the project
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * Start date of the project
     * @var \DateTime
     * @ORM\Column(type="date", nullable="true")
     */
    private $startDate;
    /**
     * Manager of the project
     * @var User
     * @ORM\ManyToOne(targetEntity="Tracktus\AppBundle\Entity\User")
     */
    private $manager;

    /**
     * Creator of the project
     * @var User
     * @ORM\ManyToOne(targetEntity="Tracktus\AppBundle\Entity\User")
     */
    private $creator;

    /**
     * Members that collaborate on this project
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tracktus\AppBundle\Entity\User")
     * @ORM\JoinTable(name="users_projects",
     *       joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")}
     *       )
     */
    private $members;

    /**
     * Indicates whether a project is finished or not
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $finished;

    /**
     * Tasks relative to the project
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Tracktus\AppBundle\Entity\Task", mappedBy="project")
     */
    private $tasks;

    /**
     * Constructor
     * @param string $name        Name of the project
     * @param string $description Description of the project
     */
    public function __construct($name = null, $description = null) {
        $this->name = $name;
        $this->description = $description;
        $this->creationDate = new \DateTime();
        $this->members = new ArrayCollection();
        $this->finished = false;
        $this->tasks = new ArrayCollection();
    }

    /**
     * Get id of the project
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the name of the project
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the description of the project
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Return the creation date of the project
     * @return \DateTime
     */
    public function createdAt()
    {
        return $this->creationDate;
    }

    /**
     * Set the name of the project
     * @param string $name Name of the project
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Sets the description of the Project
     * @param string $description Description of the project
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Return the manager of the project
     * @return User
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set the manager
     * @param User $user Manager of the project
     */
    public function setManager(User $user)
    {
        $this->manager = $user;
    }

    /**
     * Return the creator of the project
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the creator of the project
     * @param User $user Creator of the project
     */
    public function setCreator(User $user)
    {
        $this->creator = $user;
    }

    /**
     * Add a member to the project
     * @param User $user Member to add
     */
    public function addMember(User $user)
    {
        $this->members->add($user);
    }

    /**
     * Remove a member from the project
     * @param User $user
     */
    public function removeMember(User $user)
    {
        $this->members->removeElement($user);
    }

    /**
     * Get all the members of the project
     * @return ArrayCollection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Determines if a member
     * @param  User    $user the user
     * @return boolean
     */
    public function isMember(User $user)
    {
        return $this->members->contains($user);
    }

    /**
     * Set if the project is finished
     * @param boolean $state the state of the project
     * @throws \InvalidArgumentException if $state is not a boolean
     */
    public function setFinished($state)
    {
        if (!is_bool($state)){
            throw new \InvalidArgumentException('$state must be a boolean value');
        }
        $this->finished = $state;
    }

    /**
     * Return finished value of the project
     * @return boolean
     */
    public function isFinished()
    {
        return $this->finished;
    }
    
    /**
     * Return the start date of the project
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }
    
    /**
     * Set the start date of the project
     * @param \DateTime $startDate The start date
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Add a task to the project
     * @param Task $task
     */
    public function addTask($task)
    {
        $this->tasks->add($task);
    }

    /**
     * Get the list of tasks relative to a project
     * @return ArrayCollection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Remove a task from the project
     * @param $task
     */
    public function removeTask($task)
    {
        $this->tasks->removeElement($task);
    }


}
