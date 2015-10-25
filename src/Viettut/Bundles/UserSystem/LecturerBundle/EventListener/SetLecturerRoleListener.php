<?php

namespace Viettut\Bundles\UserSystem\LecturerBundle\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Viettut\Model\User\Role\BrokerInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

class SetLecturerRoleListener
{
    const ROLE_LECTURER = 'ROLE_LECTURER';

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof LecturerInterface) {
            return;
        }

        /**
         * @var UserEntityInterface $entity
         */

        $entity->setUserRoles(array(static::ROLE_LECTURER));
    }
} 