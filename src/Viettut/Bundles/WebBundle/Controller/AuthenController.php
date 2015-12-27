<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:37 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthenController extends Controller
{
    /**
     * @Route("/login", name="login_page")
     * @Template()
     */
    public function loginAction()
    {
        return $this->render('ViettutWebBundle:Authen:login.html.twig');
    }

    /**
     * @Route("/register", name="register_page")
     * @Template()
     */
    public function registerAction()
    {
        return $this->render('ViettutWebBundle:Authen:register.html.twig');
    }
}