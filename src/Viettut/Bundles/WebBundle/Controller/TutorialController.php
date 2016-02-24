<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:20 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

class TutorialController extends Controller
{
    /**
     * @Rest\Get("/lecturer/tutorials/create", name="create_tutorial")
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Tutorial:create.html.twig');
    }

    /**
     * @Rest\Get("/tutorials/all", name="tutorial_index")
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->get('viettut.repository.tutorial')->getAllTutorialQuery(),
            $request->query->getInt('page', 1)/*page number*/
        );
        return $this->render('ViettutWebBundle:Tutorial:index.html.twig', array(
            "pagination" => $pagination
        ));
    }

    /**
     * @Rest\Get("/lecturer/tutorials/mytutorials")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function myTutorialsAction()
    {
        $user = $this->getUser();

        if (!$user instanceof UserEntityInterface) {
            $this->redirectToRoute('viettut_bundles_web_authen_login');
        }

        $courses = $this->get('viettut.repository.course')->getCourseByLecturer($user);
        return $this->render('ViettutWebBundle:Course:index.html.twig', array('courses' => $courses));
    }


    /**
     * present a specific guide
     *
     * @Rest\Get("/{username}/tutorials/{hash}", name="tutorial_detail")
     * @Template()
     *
     * @param $username
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($username, $hash)
    {
        $popularSize = $this->container->getParameter('popularSize');
        $lecturer = $this->get('viettut_user.domain_manager.lecturer')->findUserByUsernameOrEmail($username);
        if (!$lecturer instanceof LecturerInterface) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        $tutorial = $this->get('viettut.repository.tutorial')->getByLecturerAndHash($lecturer, $hash);
        if(!$tutorial instanceof TutorialInterface) {
            throw new NotFoundHttpException('');
        }

        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));

        return $this->render('ViettutWebBundle:Tutorial:detail.html.twig', array(
                'username' => $username,
                'tutorial' => $tutorial,
                "popularCourses" => $popularCourses,
                "popularTutorials" => $popularTutorials
            )
        );
    }
}