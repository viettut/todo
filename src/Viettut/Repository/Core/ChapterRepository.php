<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\Role\LecturerInterface;

class ChapterRepository extends EntityRepository implements ChapterRepositoryInterface
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChapterByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('ch')
            ->where('ch.author = :author_id')
            ->setParameter('author_id', $lecturer->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChaptersByCourse(CourseInterface $course, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('ch')
            ->where('ch.course = :course_id')
            ->setParameter('course_id', $course->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }
}