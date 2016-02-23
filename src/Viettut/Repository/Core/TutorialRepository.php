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
use Viettut\Model\User\Role\LecturerInterface;

class TutorialRepository extends EntityRepository implements TutorialRepositoryInterface
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getTutorialByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.author = :author_id')
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
     * @param LecturerInterface $lecturer
     * @param $hash
     * @return mixed
     */
    public function getByLecturerAndHash(LecturerInterface $lecturer, $hash)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.author = :author_id')
            ->andWhere('t.hashTag = :hash')
            ->setParameter('hash', $hash, TYPE::STRING)
            ->setParameter('author_id', $lecturer->getId(), TYPE::INTEGER);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $maxResult
     * @return array
     */
    public function getPopularTutorial($maxResult)
    {
        $qb = $this->createQueryBuilder('t')
            ->addOrderBy('t.view', 'desc');

        if (is_int($maxResult)) {
            $qb->setMaxResults($maxResult);
        }
        else {
            $qb->setMaxResults(3);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @return mixed
     */
    public function getAllTutorialQuery()
    {
        return $this->createQueryBuilder('t')->getQuery();
    }

    public function getByTagName($tagName, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('tu')
            ->leftJoin('tu.tutorialTags', 'tt')
            ->leftJoin('tt.tag', 't')
            ->where('t.text = :tag_name')
            ->setParameter('tag_name', $tagName, Type::STRING)
        ;

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }
}