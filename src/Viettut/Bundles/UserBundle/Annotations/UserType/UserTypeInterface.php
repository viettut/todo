<?php

namespace Viettut\Bundles\UserBundle\Annotations\UserType;

interface UserTypeInterface
{
    /**
     * @return string
     */
    public function getUserClass();
}