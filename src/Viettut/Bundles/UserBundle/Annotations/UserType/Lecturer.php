<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/25/15
 * Time: 9:56 AM
 */

namespace Viettut\Bundles\UserBundle\Annotations\UserType;
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