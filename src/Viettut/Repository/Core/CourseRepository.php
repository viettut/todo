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
use Viettut\Model\User\Role\BrokerInterface;

class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{
    /**
     * @param BrokerInterface $broker
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByBroker(BrokerInterface $broker, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author_id')
            ->setParameter('author_id', $broker->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }
}