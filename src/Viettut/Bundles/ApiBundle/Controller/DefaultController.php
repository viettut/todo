<?php

namespace Viettut\Bundles\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ViettutApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
