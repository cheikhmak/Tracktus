<?php

namespace Tracktus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Configuration;

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
        return $this->render("TracktusAppBundle:ProjectLeader:dashboard.html.twig");
    }
}