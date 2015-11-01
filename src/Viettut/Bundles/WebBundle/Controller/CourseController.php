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
use Viettut\Model\User\UserEntityInterface;

class CourseController extends Controller
{
    /**
     * @Route("/lecturer/courses/create")
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Course:create.html.twig');
    }

    /**
     * @Route("/lecturer/courses/{cid}/add-chapter")
     * @param int $cid
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function addChapterAction($cid)
    {
        $user = $this->getUser();
        if (!$user instanceof UserEntityInterface) {
            $this->redirectToRoute('viettut_bundles_web_authen_login');
        }

        $course = $this->get('viettut.repository.course')->find($cid);
        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('Not found');
        }

        if ($course->getAuthor()->getId() !== $user->getId()) {
            throw new NotFoundHttpException('Not found');
        }

        return $this->render('ViettutWebBundle:Course:addChapter.html.twig', array('course' => $course));
    }

    /**
     * @Route("/courses")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function indexAction()
    {
        $courses = $this->get('viettut.repository.course')->all();
        return $this->render('ViettutWebBundle:Course:index.html.twig', array('courses' => $courses));
    }

    /**
     * @Route("/lecturer/courses/mycourses")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function myCoursesAction()
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
     * @Route("/courses/{hash}")
     * @Template()
     *
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($hash){
        $course = $this->get('viettut.repository.course')->getCourseByHashTag($hash);

        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('');
        }

        return $this->render('ViettutWebBundle:Course:detail.html.twig', array('course' => $course));
    }

    /**
     * @Route("/courses/upload")
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