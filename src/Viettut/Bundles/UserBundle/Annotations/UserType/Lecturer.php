<?php

namespace Viettut\Bundles\UserBundle\Annotations\UserType;

use Doctrine\Common\Annotations\Annotation;

use Viettut\Model\User\Role\LecturerInterface;

/**
 * @Annotation
 * @Target({"METHOD","CLASS"})
 */
class Lecturer implements UserTypeInterface
{
    public function getUserClass()
    {
        return LecturerInterface::class;
    }
}