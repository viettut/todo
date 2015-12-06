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

class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author_id')
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
     * @param $hashTag
     * @return null|CourseInterface
     */
    public function getCourseByHashTag($hashTag)
    {
        return $this->createQueryBuilder('c')
            ->where('c.hashTag = :hashTag')
            ->setParameter('hashTag', $hashTag, Type::STRING)
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $maxResult
     * @return array
     */
    public function getPopularCourse($maxResult)
    {
        $qb = $this->createQueryBuilder('c')
            ->addOrderBy('c.view', 'desc');

        if (is_int($maxResult)) {
            $qb->setMaxResults($maxResult);
        }
        else {
            $qb->setMaxResults(3);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @param $maxResult
     * @return array
     */
    public function getRecentCourse($maxResult)
    {
        $qb = $this->createQueryBuilder('c')
            ->addOrderBy('c.createdAt', 'desc');

        if (is_int($maxResult)) {
            $qb->setMaxResults($maxResult);
        }
        else {
            $qb->setMaxResults(3);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @param LecturerInterface $lecturer
     * @param $hashTag
     * @return mixed
     */
    public function getByLecturerAndHash(LecturerInterface $lecturer, $hashTag)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author_id')
            ->andWhere('c.hashTag = :hashTag')
            ->setParameter('author_id', $lecturer->getId(), TYPE::INTEGER)
            ->setParameter('hashTag', $hashTag, Type::STRING)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function getAllCourseQuery()
    {
        return $this->createQueryBuilder('c')->getQuery();
    }


}