<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 24/02/2016
 * Time: 22:02
 */

namespace Viettut\Bundles\WebBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Viettut\Bundles\ApiBundle\Controller\RestControllerAbstract;
use Viettut\Handler\HandlerInterface;

/**
 * @RouteResource("Public")
 */
class SearchController extends RestControllerAbstract implements ClassResourceInterface
{
    /**
     * @Rest\Post("/public/api/search")
     * @param Request $request
     * @return array
     */
    public function searchAction(Request $request)
    {
        $params = $request->request->all();
        if (!array_key_exists('keyword', $params)) {
            return [];
        }

        $courses = $this->get('viettut.repository.course')->search($params['keyword']);
        $tutorials = $this->get('viettut.repository.tutorial')->search($params['keyword']);

        return array (
            'courses' => $courses,
            'tutorials' => $tutorials
        );
    }

    protected function getResourceName()
    {
        // TODO: Implement getResourceName() method.
    }

    protected function getGETRouteName()
    {
        // TODO: Implement getGETRouteName() method.
    }

    protected function getHandler()
    {
        // TODO: Implement getHandler() method.
    }
}