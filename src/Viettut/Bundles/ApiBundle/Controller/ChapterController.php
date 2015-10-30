<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:24 PM
 */

namespace Viettut\Bundles\ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Viettut\Handler\HandlerInterface;

/**
 * @RouteResource("Chapter")
 */
class ChapterController extends RestControllerAbstract implements ClassResourceInterface
{

    
    /**
     * @return string
     */
    protected function getResourceName()
    {
        return 'chapter';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'api_1_get_chapter';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_api.handler.chapter');
    }
}