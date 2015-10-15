<?php

namespace Viettut\Bundles\AdminApiBundle\Handler;

use Viettut\Bundles\UserBundle\DomainManager\BrokerManagerInterface;
use Viettut\Handler\HandlerAbstract;

/**
 * Not using a RoleHandlerInterface because this Handler is local
 * to the admin api bundle. All routes to this bundle are protected in app/config/security.yml
 */
class UserHandler extends HandlerAbstract implements UserHandlerInterface
{
    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return BrokerManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }

    /**
     * @inheritdoc
     */
    public function allBrokers()
    {
        return $this->getDomainManager()->allBrokers();
    }
}