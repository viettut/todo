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
        $popularSize = $this->container->getParameter('popularSize');
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

        $lastChapter = true;
        $nextChapter = $this->get('viettut.repository.chapter')->getChapterByCourseAndPosition($course, $chapter->getPosition() + 1);
        if ($chapter->getPosition() == count($course->getChapters()) || !$nextChapter instanceof ChapterInterface) {
            $lastChapter = false;
        }

        $comments = $this->get('viettut.domain_manager.comment')->getByChapter($chapter);
        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));

        return $this->render('ViettutWebBundle:Chapter:detail.html.twig', array(
            'username' => $username,
            'chapter' => $chapter,
            'course' => $course,
            "comments" => $comments,
            "popularCourses" => $popularCourses,
            "popularTutorials" => $popularTutorials,
            "lastChapter" => $lastChapter,
            "nextChapter" => $nextChapter
        ));
    }

    /**
     * @Route("/{username}/courses/{hash}/{cHash}/next", name="next_chapter_detail")
     * @param $username
     * @param $hash
     * @param $cHash
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function nextAction($username, $hash, $cHash)
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

        if ($chapter->getCourse()->getId() != $course->getId()) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        if ($chapter->getPosition() == count($course->getChapters())) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        $nextChapter = $this->get('viettut.repository.chapter')->getChapterByCourseAndPosition($course, $chapter->getPosition());
        if (!$nextChapter instanceof ChapterInterface) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        return $this->redirectToRoute('chapter_detail', array(
                'username' => $course->getAuthor()->getUsername(),
                'hash' => $course->getHashTag(),
                'cHash' => $nextChapter->getHashTag()
            )
        );
    }
}