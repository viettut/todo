<?php

namespace Viettut\Bundles\UserSystem\BrokerBundle\Controller;

use Viettut\Bundles\ApiBundle\Controller\RestControllerAbstract;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Bundles\AdminApiBundle\Handler\UserHandlerInterface;

/**
 * @Rest\RouteResource("brokers/current")
 */
class BrokerController extends RestControllerAbstract implements ClassResourceInterface
{
    /**
     * Get current broker
     *
     * @return \Viettut\Bundles\UserBundle\Entity\User
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction()
    {
        $brokerId = $this->get('security.context')->getToken()->getUser()->getId();

        return $this->one($brokerId);
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
        $brokerId = $this->get('security.context')->getToken()->getUser()->getId();

        return $this->patch($request, $brokerId);
    }

    /**
     * @inheritdoc
     */
    protected function getResourceName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    protected function getGETRouteName()
    {
        return 'broker_api_1_get_current';
    }

    /**
     * @return UserHandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_admin_api.handler.user');
    }
}
