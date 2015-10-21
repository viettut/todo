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

class TutorialRepository extends EntityRepository implements TutorialRepositoryInterface
{
    /**
     * @param BrokerInterface $broker
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getTutorialByBroker(BrokerInterface $broker, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.author = :author_id')
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