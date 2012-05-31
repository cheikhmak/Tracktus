<?php

namespace Tracktus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Configuration;
use Tracktus\AppBundle\Entity\Project;
use Tracktus\AppBundle\Entity\User;
use Tracktus\AppBundle\Form\Type\ProjectFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
* Project Leader controller
*/
class ProjectLeaderController extends Controller
{
    /**
     * Show Project Leader Dashboard
     * @return Response
     */
    public function showDashboardAction()
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
     * @param Project $project The project
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
     * @param Request $request
     * @return Response
     * @Configuration\Route("/project/new", name="project_new")
     * @Configuration\Method({"GET", "POST"})
     */
    public function newProjectAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm(new ProjectFormType(), $project);
        $form->remove('startDate');

        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $user = $this->get('security.context')->getToken()->getUser();
                $project->setManager($user);
                $project->setCreator($user);
                $em->persist($project);
                $em->flush();
                return $this->redirect($this->generateUrl('project_show', 
                        array('id'=>$project->getId())));
            }
        }
        return $this->render('TracktusAppBundle:ProjectLeader:newProject.html.twig',
                array('form' => $form->createView()));
        
    }
    
    /**
     * Delete a project
     * @param Project $project
     * @return RedirectResponse
     * @Configuration\Route("/project/delete/{id}", requirements={"id" = "\d+"}, name="project_delete")
     * @Configuration\Method("GET")
     */
    public function deleteProject(Project $project) {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($project);
        $em->flush();
        return $this->redirect($this->generateUrl("dashboard"));
    }
    
    /**
     * Configure the parameters of the project
     * @param Project $project
     * @return Response
     * @Configuration\Route("/project/config/{id}", requirements={"id" = "\d+"}, name="project_config")
     * @Configuration\Method({"GET", "POST"})
     */
    public function configureParameters(Project $project)
    {
        $form = $this->createForm(new ProjectFormType(), $project);
        $request = $this->getRequest();
        if ($request->getMethod() === 'POST')
        {
            $form->bindRequest($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($project);
                $em->flush();
            }
        }
        return $this->render('TracktusAppBundle:ProjectLeader:parameters.html.twig',
                array('configForm' => $form->createView(),
                         'project' => $project));
    }
}