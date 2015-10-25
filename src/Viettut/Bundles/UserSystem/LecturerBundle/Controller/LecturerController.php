<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/25/15
 * Time: 9:41 AM
 */

namespace Viettut\Bundles\UserSystem\LecturerBundle\Controller;


use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Bundles\ApiBundle\Controller\RestControllerAbstract;
use Viettut\Handler\HandlerInterface;

/**
 * @Rest\RouteResource("lecturers/current")
 */
class LecturerController extends RestControllerAbstract implements ClassResourceInterface
{
    /**
     * Get current broker
     *
     * @return \Viettut\Bundles\UserBundle\Entity\User
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction()
    {
        $lecturerId = $this->get('security.context')->getToken()->getUser()->getId();

        return $this->one($lecturerId);
    }

    /**
     * Update current broker from the submitted data
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when resource not exist
     */
    public function patchAction(Request $request)
    {
        $lecturerId = $this->get('security.context')->getToken()->getUser()->getId();

        return $this->patch($request, $lecturerId);
    }

    /**
     * @return string
     */
    protected function getResourceName()
    {
        return 'user';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'lecturer_api_1_get_current';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_admin_api.handler.user');
    }
}