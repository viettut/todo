<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Viettut\Model\User\Role\BrokerInterface;

interface ChapterManagerInterface extends ManagerInterface
{
    /**
     * @param BrokerInterface $broker
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChapterByBroker(BrokerInterface $broker, $limit = null, $offset = null);
}