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
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Handler\HandlerInterface;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;

/**
 * @RouteResource("Chapter")
 */
class ChapterController extends RestControllerAbstract implements ClassResourceInterface
{

    /**
     * Get all chapter
     *
     * @Rest\View(
     *      serializerGroups={"chapter.summary", "user.summary"}
     * )
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful"
     *  }
     * )
     *
     * @return ChapterInterface[]
     */
    public function cgetAction()
    {
        return $this->all();
    }

    /**
     * Get a single chapter for the given id
     *
     * @Rest\View(
     *      serializerGroups={"chapter.detail", "user.summary", "comment.summary"}
     * )
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the resource is not found"
     *  }
     * )
     *
     * @param int $id the resource id
     *
     * @return ChapterInterface
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction($id)
    {
        return $this->one($id);
    }


    /**
     *
     * @Rest\View(
     *      serializerGroups={"chapter.summary", "user.summary", "comment.detail"}
     * )
     * @param $id
     * @return mixed
     */
    public function cgetCommentsAction($id)
    {
        $chapter = $this->one($id);

        $commentManager = $this->get('viettut.domain_manager.comment');
        return $commentManager->getByChapter($chapter);
    }


    /**
     * Create a chapter from the submitted data
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the submitted data has errors"
     *  }
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postAction(Request $request)
    {
        return $this->post($request);
    }

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