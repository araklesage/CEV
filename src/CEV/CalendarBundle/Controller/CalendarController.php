<?php

namespace CEV\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CalendarController extends Controller
{
    /**
     * @Route("/", name= "calendar")
     */
    public function indexAction()
    {
        return $this->render('Core/calendar.html.twig');
    }
}
