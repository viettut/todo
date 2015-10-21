<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:04 PM
 */

namespace Viettut\Model\Core;


use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\User\UserEntityInterface;
use Viettut\Model\ModelInterface;

interface CourseInterface extends ModelInterface
{
    /**
     * @param $id
     * @return self
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set author
     *
     * @param UserEntityInterface $author
     * @return self
     */
    public function setAuthor(UserEntityInterface $author);

    /**
     * Get author
     *
     * @return UserEntityInterface
     */
    public function getAuthor();

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
     * Set view
     *
     * @param integer $view
     * @return self
     */
    public function setView($view);

    /**
     * Get view
     *
     * @return integer
     */
    public function getView();

    /**
     * Set enroll
     *
     * @param integer $enroll
     * @return self
     */
    public function setEnroll($enroll);

    /**
     * Get enroll
     *
     * @return integer
     */
    public function getEnroll();

    /**
     * @return ArrayCollection
     */
    public function getChapters();

    /**
     * @param ChapterInterface[] $chapters
     * @return self
     */
    public function setChapters($chapters);

    /**
     * @return string
     */
    public function getIntroduce();

    /**
     * @param string $introduce
     * @return self
     */
    public function setIntroduce($introduce);

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt();

    /**
     * @return string
     */
    public function getImagePath();

    /**
     * @param string $imagePath
     * @return self
     */
    public function setImagePath($imagePath);

    /**
     * @return string
     */
    public function getHashTag();

    /**
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();
}