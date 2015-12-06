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
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

class TutorialController extends Controller
{
    /**
     * @Route("/lecturer/tutorials/create")
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Tutorial:create.html.twig');
    }

    /**
     * @Route("/tutorials")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function indexAction()
    {
        $tutorials = $this->get('viettut.repository.tutorial')->findAll();
        return $this->render('ViettutWebBundle:Tutorial:index.html.twig', array('tutorials' => $tutorials));
    }

    /**
     * @Route("/lecturer/tutorials/mytutorials")
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
     * @Route("/{username}/tutorials/{hash}", name="tutorial_detail")
     * @Template()
     *
     * @param $username
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($username, $hash)
    {
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

        $comments = $this->get('viettut.domain_manager.comment')->getByTutorial($tutorial);

        return $this->render('ViettutWebBundle:Tutorial:detail.html.twig', array('username' => $username, 'tutorial' => $tutorial, "comments" => $comments));
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