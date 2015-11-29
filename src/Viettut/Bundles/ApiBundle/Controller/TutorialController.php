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
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @RouteResource("Tutorial")
 */
class TutorialController extends RestControllerAbstract implements ClassResourceInterface
{

    /**
     *
     * @Rest\View(
     *      serializerGroups={"tutorial.summary", "user.summary", "comment.detail"}
     * )
     * @param $id
     * @return mixed
     */
    public function cgetCommentsAction($id)
    {
        $tutorial = $this->one($id);

        $commentManager = $this->get('viettut.domain_manager.comment');
        return $commentManager->getByTutorial($tutorial);
    }

    /**
     * @return string
     */
    protected function getResourceName()
    {
        return 'tutorial';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'api_1_get_tutorial';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_api.handler.tutorial');
    }
}