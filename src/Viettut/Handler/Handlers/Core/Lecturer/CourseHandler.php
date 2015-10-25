<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core\Lecturer;


use Viettut\Handler\Handlers\Core\CourseHandlerAbstract;
use Viettut\Model\User\Role\BrokerInterface;
use Viettut\Model\User\Role\UserRoleInterface;

class CourseHandler extends CourseHandlerAbstract{

    /**
     * @param UserRoleInterface $role
     * @return bool
     */
    public function supportsRole(UserRoleInterface $role)
    {
        return $role instanceof BrokerInterface;
    }

    /**
     * @inheritdoc
     */
    public function all($limit = null, $offset = null)
    {
        /** @var BrokerInterface $broker */
        $broker = $this->getUserRole();
        return $this->getDomainManager()->getCourseByBroker($broker, $limit, $offset);
    }
}