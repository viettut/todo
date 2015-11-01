<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 11/1/15
 * Time: 2:24 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LecturerController extends Controller
{
    /**
     * @Route("/{username}")
     * @param string $username
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function indexAction($username)
    {
        $author = $this->get('viettut_user_system_lecturer.user_manager')->findUserByUsername($username);
        if (!$author instanceof UserInterface) {
            $this->createNotFoundException('Page not found');
        }

        $courses = $this->get('viettut.repository.course')->getCourseByLecturer($author);
        $tutorials = $this->get('viettut.repository.tutorial')->getTutorialByLecturer($author);

        return $this->render('ViettutWebBundle:Lecturer:index.html.twig', array(
           'courses' => $courses,
            'tutorials' =>  $tutorials
        ));
    }
}