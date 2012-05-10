<?php

namespace Tracktus\AppBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository;
use Tracktus\UserBundle\Entity\User;

/**
* Manager which contains all databases action relative to projects
*/
class ProjectManager
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(
            'Tracktus\AppBundle\Entity\Project');
    }

    /**
     * Get the projects owned by a given manager
     * @param  User   $user Manager
     * @return ArrayCollection  Projects owned by the manager
     */
    public function getProjectsOwnedBy(User $user)
    {
        $query = $this->em->createQuery('SELECT p FROM 
            Tracktus\AppBundle\Entity\Project p WHERE p.manager = :user')
            ->setParameter('user', $user);
        return $query->getResult();
    }
}