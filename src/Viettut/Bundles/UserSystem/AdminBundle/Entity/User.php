<?php

namespace Viettut\Bundles\UserSystem\AdminBundle\Entity;

use Viettut\Bundles\UserBundle\Entity\User as BaseUser;
use Viettut\Model\User\Role\AdminInterface;
use Viettut\Model\User\UserEntityInterface;

class User extends BaseUser implements AdminInterface
{
    protected $id;
    protected $settings;

    /**
     * @return UserEntityInterface
     */
    public function getUser()
    {
        return $this;
    }
}
