<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/25/15
 * Time: 3:52 PM
 */

namespace Viettut\Bundles\UserBundle\Handler;

use Viettut\Bundles\UserBundle\DomainManager\LecturerManagerInterface;
use Viettut\Handler\HandlerAbstract;

class UserHandler extends HandlerAbstract implements UserHandlerInterface
{
    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return LecturerManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }


    /**
     * @return array
     */
    public function allLecturers()
    {
        return $this->getDomainManager()->allLecturers();
    }
}