<?php
namespace Tracktus\AppBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;
use Tracktus\AppBundle\Entity\User;

/**
 * Repository of Project entity
 *
 * @author pierre
 */
class ProjectRepository extends EntityRepository
{
    /**
     * Get the projects owned by a given manager
     * @param  User   $user Manager
     * @return ArrayCollection  Projects owned by the manager
     */
    public function getProjectsOwnedBy(User $user)
    {
//        $query = $this->em->createQuery('SELECT p FROM 
//            Tracktus\AppBundle\Entity\Project p WHERE p.manager = :user')
//            ->setParameter('user', $user);
//        return $query->getResult();
        return $this->createQueryBuilder('p')
                ->where('p.manager = :user')
                ->setParameter('user', $user)
                ->addOrderBy('p.creationDate', 'DESC')
                ->getQuery()
                ->getResult();
    }
}