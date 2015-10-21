<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core\Broker;


use Viettut\Handler\Handlers\Core\ChapterHandlerAbstract;
use Viettut\Model\User\Role\BrokerInterface;
use Viettut\Model\User\Role\UserRoleInterface;

class ChapterHandler extends ChapterHandlerAbstract{

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
        return $this->getDomainManager()->getChapterByBroker($broker, $limit, $offset);
    }
}