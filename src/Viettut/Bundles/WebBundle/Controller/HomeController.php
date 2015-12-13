<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:42 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home_page")
     * @param $request
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $popularSize = $this->container->getParameter('popularSize');
        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));
        return $this->render('ViettutWebBundle:Home:index.html.twig', array(
            "popularCourses" => $popularCourses,
            "popularTutorial" => $popularTutorials
        ));
    }
}