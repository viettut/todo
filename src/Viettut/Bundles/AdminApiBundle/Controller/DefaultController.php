<?php

namespace Viettut\Bundles\AdminApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ViettutAdminApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
