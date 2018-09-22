<?php

namespace CEV\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/news")
     */
    public function indexAction()
    {
        return $this->render('CEVNewsBundle:Default:index.html.twig');
    }
}
