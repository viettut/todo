<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:20 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Entity\Core\Course;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Utilities\StringFactory;

class CourseController extends FOSRestController
{
    use StringFactory;
    /**
     * @Rest\Get("/courses/create", name="create_course")
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Course:create.html.twig');
    }

    /**
     * @Rest\Get("/courses/{token}/add-chapter")
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function addChapterAction($token)
    {
        $course = $this->get('viettut.repository.course')->getCourseByToken($token);
        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('course not found or you do not have enough permission');
        }

        return $this->render('ViettutWebBundle:Course:addChapter.html.twig', array(
                'course' => $course,
                'html' => $this->highlightCode($course->getIntroduce())
            )
        );
    }

    /**
     * @Rest\Get("/courses/{token}/edit")
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function editAction($token)
    {
        $course = $this->get('viettut.repository.course')->getCourseByToken($token);
        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('course not found or you do not have enough permission');
        }

        return $this->render('ViettutWebBundle:Course:edit.html.twig', array(
                'course' => $course,
                'html' => $this->highlightCode($course->getIntroduce())
            )
        );
    }

    /**
     * @Rest\Get("/courses/all", name="course_index")
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->get('viettut.repository.course')->getAllCourseQuery(),
            $request->query->getInt('page', 1)/*page number*/
        );
        return $this->render('ViettutWebBundle:Course:index.html.twig', array(
            "pagination" => $pagination
        ));
    }

    /**
     * @Rest\Get("/lecturer/courses/mycourses")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function myCoursesAction()
    {
        return $this->render('ViettutWebBundle:Course:myCourses.html.twig');
    }


    /**
     * present a specific guide
     *
     * @Rest\Get("/{username}/courses/{hash}", name="course_detail")
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

        $course = $this->get('viettut.repository.course')->getByLecturerAndHash($lecturer, $hash);

        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('');
        }
        $lastChapter = true;
        $nextChapter = $this->get('viettut.repository.chapter')->getChapterByCourseAndPosition($course, 1);
        if (!$nextChapter instanceof ChapterInterface) {
            $lastChapter = false;
        }

        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));

        return $this->render('ViettutWebBundle:Course:detail.html.twig', array(
            'username' => $username,
            'course' => $course,
            'html' => $this->highlightCode($course->getIntroduce()),
            "popularCourses" => $popularCourses,
            "popularTutorials" => $popularTutorials,
            "lastChapter" => $lastChapter,
            "nextChapter" => $nextChapter
        ));
    }

    /**
     * @Rest\Post("/courses/upload")
     * @param Request $request
     * @return string
     */
    public function uploadImage(Request $request)
    {
        $uploadRootDir = $this->container->getParameter('uploadRootDirectory');
        $uploadDir = $this->container->getParameter('uploadDirectory');
        foreach ($_FILES as $file) {

            $uploadFile = new UploadedFile($file['tmp_name'], $file['name'], $file['type'], $file['size'], $file['error'], $test = false);
            $baseName = uniqid('', true);
            $uploadFile->move($uploadRootDir,
                $baseName.substr($uploadFile->getClientOriginalName(), -4)
            );

            return new JsonResponse(join('/', array($uploadDir, $baseName.substr($uploadFile->getClientOriginalName(), -4))));
        }
        throw new InvalidArgumentException('Invalid files');
    }
}