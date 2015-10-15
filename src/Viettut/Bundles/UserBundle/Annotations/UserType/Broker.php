<?php

namespace Viettut\Bundles\UserBundle\Annotations\UserType;

use Doctrine\Common\Annotations\Annotation;

use Viettut\Model\User\Role\BrokerInterface;

/**
 * @Annotation
 * @Target({"METHOD","CLASS"})
 */
class Broker implements UserTypeInterface
{
    public function getUserClass()
    {
        return BrokerInterface::class;
    }
}