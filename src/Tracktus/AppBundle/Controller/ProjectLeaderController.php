<?php

namespace Tracktus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Configuration;
use Tracktus\AppBundle\Entity\Project;
use Tracktus\AppBundle\Entity\ProjectManager;
use Tracktus\UserBundle\Entity\User;
use Tracktus\AppBundle\Form\Type\ProjectFormType;

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
        
        $user = $this->get('security.context')->getToken()->getUser();
        $projects = $em->getRepository('Tracktus\AppBundle\Entity\Project')
                ->getProjectsOwnedBy($user);
        return $this->render('TracktusAppBundle:ProjectLeader:dashboard.html.twig',
            array('projects' => $projects));
    }

    /**
     * Show project details
     * @param  int $id Project's id
     * @return Response
     * @Configuration\Route("/project/{id}", requirements={"id" = "\d+"}, name="project_show")
     * @Configuration\Method("GET")
     */
    public function showProjectDetailAction(Project $project)
    {   
        return $this->render('TracktusAppBundle:ProjectLeader:showProject.html.twig', 
            array('project' => $project));
    }

    /**
     * Create a new blank project
     * @return Response
     * @Configuration\Route("/project/new", name="project_new")
     * @Configuration\Method({"GET", "POST"})
     */
    public function newProjectAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm(new ProjectFormType(), $project);

        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $user = $this->get('security.context')->getToken()->getUser();
                $project->setManager($user);
                $project->setCreator($user);
                $em->persist($project);
                $em->flush();
                return $this->redirect($this->generateUrl('dashboard'));
            }
        }
        return $this->render('TracktusAppBundle:ProjectLeader:newProject.html.twig',
                array('form' => $form->createView()));
        
    }
}