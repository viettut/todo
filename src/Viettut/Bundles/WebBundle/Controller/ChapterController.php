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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\Role\LecturerInterface;

class ChapterController extends Controller
{
    /**
     * present a specific guide
     *
     * @Route("/{username}/courses/{hash}/{cHash}", name="chapter_detail")
     * @Template()
     *
     * @param $username
     * @param $hash
     * @param $cHash
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($username, $hash, $cHash)
    {
        $lecturer = $this->get('viettut_user.domain_manager.lecturer')->findUserByUsernameOrEmail($username);
        if (!$lecturer instanceof LecturerInterface) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        $course = $this->get('viettut.repository.course')->getByLecturerAndHash($lecturer, $hash);
        if (!$course instanceof CourseInterface) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        $chapter = $this->get('viettut.repository.chapter')->getChapterByCourseAndHash($course, $cHash);
        if (!$chapter instanceof ChapterInterface) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        $comments = $this->get('viettut.domain_manager.comment')->getByChapter($chapter);

        return $this->render('ViettutWebBundle:Chapter:detail.html.twig', array('username' => $username, 'chapter' => $chapter, 'course' => $course, "comments" => $comments));
    }
}