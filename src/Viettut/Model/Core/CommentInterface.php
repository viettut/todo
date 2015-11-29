<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\User\UserEntityInterface;
use Viettut\Model\ModelInterface;

interface CommentInterface extends ModelInterface
{
    /**
     * @param $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set active
     *
     * @param boolean $active
     * @return self
     */
    public function setActive($active);

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive();

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt();

    /**
     * @return UserEntityInterface
     */
    public function getAuthor();

    /**
     * @param UserEntityInterface $author
     * @return self
     */
    public function setAuthor(UserEntityInterface $author);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return int
     */
    public function getLike();

    /**
     * @param int $like
     * @return self
     */
    public function setLike($like);

    /**
     * @return CourseInterface
     */
    public function getCourse();

    /**
     * @param CourseInterface $course
     * @return self
     */
    public function setCourse($course);

    /**
     * @return ChapterInterface
     */
    public function getChapter();

    /**
     * @param ChapterInterface $chapter
     * @return self
     */
    public function setChapter($chapter);

    /**
     * @return TutorialInterface
     */
    public function getTutorial();

    /**
     * @param TutorialInterface $tutorial
     * @return self
     */
    public function setTutorial($tutorial);

    /**
     * @return ArrayCollection
     */
    public function getChildren();

    /**
     * @param ArrayCollection $children
     * @return self
     */
    public function setChildren($children);

    /**
     * @param CommentInterface $child
     * @return self
     */
    public function addChildren(CommentInterface $child);

    /**
     * @return CommentInterface
     */
    public function getParent();

    /**
     * @param CommentInterface $parent
     * @return self
     */
    public function setParent($parent);
}