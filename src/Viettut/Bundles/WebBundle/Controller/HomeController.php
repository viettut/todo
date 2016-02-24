<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:42 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Model\User\Role\LecturerInterface;

class HomeController extends FOSRestController
{
    /**
     * @Rest\Get("/", name="home_page")
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

    /**
     * @Rest\Get("/user/active/{hash}", name="user_active")
     * @param $hash
     * @Template()
     */
    public function activeAction($hash)
    {
        $userManager = $this->container->get('viettut_user.domain_manager.lecturer');
        $user = $userManager->findUserByActiveCode($hash);
        if ($user instanceof LecturerInterface) {
            if ($user->getActive() == false) {
                $user->setActive(true);
            }

            return $this->render('ViettutWebBundle:Home:active.html.twig');
        }

        throw new NotFoundHttpException('Page not found');
    }

}