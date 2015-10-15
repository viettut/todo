<?php

namespace Viettut\Bundles\UserSystem\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ViettutUserSystemAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
