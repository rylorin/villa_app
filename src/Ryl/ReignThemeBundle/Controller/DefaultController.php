<?php

namespace Ryl\ReignThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RylLandingBundle:Default:index.html.twig', array('name' => $name));
    }
}
