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
use Viettut\Entity\Core\Subscriber;
use Viettut\Model\Core\SubscriberInterface;
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
        $popularSize = $this->container->getParameter('popular_size');
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

    /**
     * @Rest\Post("/public/api/subscribe", name="user_subscribe")
     * @param Request $request
     */
    public function subscribeAction(Request $request)
    {
        $params = $request->request->all();

        if (!array_key_exists('email', $params)) {
            return false;
        }

        $subscriber = $this->get('viettut.repository.subscriber')->getByEmail($params['email']);

        if (!$subscriber instanceof SubscriberInterface) {
            $subscriber = new Subscriber();
            $subscriber->setEmail($params['email']);
            $this->getDoctrine()->getEntityManager()->persist($subscriber);
            $this->getDoctrine()->getEntityManager()->flush();
        }

        return true;
    }

    /**
     * @Rest\Get("/coming-soon", name="coming_soon")
     * @Template()
     */
    public function comingSoonAction()
    {
        return $this->render('ViettutWebBundle:Home:comingSoon.html.twig');
    }
}