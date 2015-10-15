<?php

namespace Viettut\Bundles\AdminApiBundle\Handler;

use Viettut\Handler\HandlerInterface;

interface UserHandlerInterface extends HandlerInterface
{
    /**
     * @return array
     */
    public function allBrokers();
}