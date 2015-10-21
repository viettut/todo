<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\Common\Persistence\ObjectRepository;
use Viettut\Model\User\Role\BrokerInterface;

interface CourseRepositoryInterface extends ObjectRepository
{
    /**
     * @param BrokerInterface $broker
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByBroker(BrokerInterface $broker, $limit = null, $offset = null);
}