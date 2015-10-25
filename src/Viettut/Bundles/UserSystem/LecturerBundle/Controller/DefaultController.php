<?php

namespace Viettut\Bundles\UserSystem\LecturerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ViettutUserSystemLecturerBundle:Default:index.html.twig', array('name' => $name));
    }
}
