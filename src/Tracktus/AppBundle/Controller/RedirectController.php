<?php
namespace Tracktus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Configuration;

/**
* Controller which redirect user after authentication
*/
class RedirectController extends Controller
{
    /**
     * Redirect the to the dashboard route
     * @param  Request $request Incomming request
     * @return RedirectResponse
     * @Configuration\Route("/", name="homepage")
     */
    public function redirectToDashboardAction(Request $request)
    {
        /**
         * @var Tracktus\AppBundle\Entity\User
         */
        $user = $this->get('security.context')->getToken()->getUser();
        
        if ($user->hasRole('USER_PROJECT_LEADER')) {
            return $this->redirect($this->generateUrl('dashboard'));
        }
        //return new Response($user->getUserName());
        
    }

    /**
     * Call the controller which show the right dashboard
     * @param  Request $request Incomming Request
     * @return Response
     * @Configuration\Route("/dashboard", name="dashboard")
     */
    public function dashboardShowAction(Request $request)
    {
        return $this->forward("TracktusAppBundle:ProjectLeader:showDashboard");
    }
}