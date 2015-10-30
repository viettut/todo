<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/25/15
 * Time: 3:51 PM
 */

namespace Viettut\Bundles\UserBundle\Handler;


use Viettut\Handler\HandlerInterface;

interface UserHandlerInterface extends HandlerInterface{
    /**
     * @return array
     */
    public function allLecturers();
}