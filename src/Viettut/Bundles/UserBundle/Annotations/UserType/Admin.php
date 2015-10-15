<?php

namespace Viettut\Bundles\UserBundle\Annotations\UserType;

use Doctrine\Common\Annotations\Annotation;

use Viettut\Model\User\Role\AdminInterface;

/**
 * @Annotation
 * @Target({"METHOD","CLASS"})
 */
class Admin implements UserTypeInterface
{
    public function getUserClass()
    {
        return AdminInterface::class;
    }
}