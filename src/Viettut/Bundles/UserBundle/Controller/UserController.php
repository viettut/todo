<?php

namespace Viettut\Bundles\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Handler\HandlerInterface;

/**
 * @RouteResource("User")
 * Class UserController
 * @package Viettut\Bundles\UserBundle\Controller
 */
class UserController extends FOSRestController
{
    /**
     * @View()
     * @param Request $request
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function postAction(Request $request)
    {
        $username = $request->request->get('username');
        if($username === null || empty($username) || strlen($username) < 6) {
            throw new InvalidArgumentException('username must have at least 6 characters');
        }

        $password = $request->request->get('password');
        if($password === null || empty($password) || strlen($password) < 8) {
            throw new InvalidArgumentException('password must have at least 8 characters');
        }

        $email = $request->request->get('email');
        if($email === null || empty($email)) {
            throw new InvalidArgumentException('email can not be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email');
        }

        $name = $request->request->get('name');
        $professional = $request->request->get('gender');

        $userManager = $this->container->get('viettut_user.domain_manager.lecturer');

        $found = $userManager->findUserByUsernameOrEmail($username);
        if($found instanceof UserInterface) {
            throw new InvalidArgumentException('username existed');
        }

        $found = $userManager->findUserByUsernameOrEmail($email);
        if($found instanceof UserInterface) {
            throw new InvalidArgumentException('email existed');
        }

        $userDiscriminator = $this->get('rollerworks_multi_user.user_discriminator');
        $userDiscriminator->setCurrentUser('viettut_user_system_lecturer');
        $user = $userManager->createNew();
        $activeCode = uniqid('', true);
        $link = sprintf('http://viettut.com/user/active/%s', $activeCode);
        $user->setEnabled(true)
            ->setPlainPassword($password)
            ->setUsername($username)
            ->setEmail($email)
            ->setName($name)
            ->setProfessional($professional)
            ->setActive(false)
            ->setActiveCode($activeCode)
        ;
        $hash = md5(trim($email));
        $user->setAvatar(sprintf('http://gravatar.com/avatar/%s?size=64&d=identicon', $hash));
        $userManager->save($user);

        $routeOptions = array(
            '_format' => 'json'
        );

        $message = \Swift_Message::newInstance()
            ->setSubject('Welcome aboard !')
            ->setFrom('noreply@viettut.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    ':Emails:welcome.html.twig',
                    array(
                        'name' => $name,
                        'link' => $link
                    )
                ),
                'text/html'
            )
        ;

        $this->get('mailer')->send($message);
        return $this->view($user, Codes::HTTP_CREATED, $routeOptions);
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
        return 'api_1_get_courses';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_user_api.handler.user');
    }
}
