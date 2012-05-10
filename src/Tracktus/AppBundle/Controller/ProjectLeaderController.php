<?php

namespace Tracktus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Configuration;
use Tracktus\AppBundle\Entity\Project;
use Tracktus\AppBundle\Entity\ProjectManager;
use Tracktus\UserBundle\Entity\User;

/**
* Project Leader controller
*/
class ProjectLeaderController extends Controller
{
    /**
     * Show Project Leader Dashboard
     * @param  Request $request Incomming Request
     * @return Response
     */
    public function showDashboardAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $projectManager = new ProjectManager($em);
        $user = $this->get('security.context')->getToken()->getUser();
        $projects = $projectManager->getProjectsOwnedBy($user);
        return $this->render('TracktusAppBundle:ProjectLeader:dashboard.html.twig',
            array('projects' => $projects));
    }

    /**
     * Show project details
     * @param  int $id Project's id
     * @return Response
     * @Configuration\Route("/projects/{id}", name="project_show")
     */
    public function showProjectAction(Project $project)
    {
        // $project = $this->getDoctrine()
        //     ->getRepository('Tracktus\AppBundle\Entity\Project')
        //     ->find($id);
        // if (!$project) {
        //     throw new $this->createNotFoundException('Project '.$id.' not found');
            
        // }
        
        return $this->render('TracktusAppBundle:ProjectLeader:showProject.html.twig', 
            array('project' => $project));
    }
}