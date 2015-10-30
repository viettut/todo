<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/admin/v1/users')) {
                // admin_api_1_get_users
                if ($pathinfo === '/api/admin/v1/users') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_api_1_get_users;
                    }

                    return array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::cgetAction',  '_format' => 'json',  '_route' => 'admin_api_1_get_users',);
                }
                not_admin_api_1_get_users:

                // admin_api_1_get_user
                if (preg_match('#^/api/admin/v1/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_api_1_get_user;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_api_1_get_user')), array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::getAction',  '_format' => 'json',));
                }
                not_admin_api_1_get_user:

                // admin_api_1_get_user_token
                if (preg_match('#^/api/admin/v1/users/(?P<lecturerId>[^/]++)/token$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_api_1_get_user_token;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_api_1_get_user_token')), array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::getTokenAction',  '_format' => 'json',));
                }
                not_admin_api_1_get_user_token:

                // admin_api_1_post_user
                if ($pathinfo === '/api/admin/v1/users') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_admin_api_1_post_user;
                    }

                    return array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::postAction',  '_format' => 'json',  '_route' => 'admin_api_1_post_user',);
                }
                not_admin_api_1_post_user:

                // admin_api_1_put_user
                if (preg_match('#^/api/admin/v1/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_admin_api_1_put_user;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_api_1_put_user')), array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::putAction',  '_format' => 'json',));
                }
                not_admin_api_1_put_user:

                // admin_api_1_patch_user
                if (preg_match('#^/api/admin/v1/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PATCH') {
                        $allow[] = 'PATCH';
                        goto not_admin_api_1_patch_user;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_api_1_patch_user')), array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::patchAction',  '_format' => 'json',));
                }
                not_admin_api_1_patch_user:

                // admin_api_1_delete_user
                if (preg_match('#^/api/admin/v1/users/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_api_1_delete_user;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_api_1_delete_user')), array (  '_controller' => 'Viettut\\Bundles\\AdminApiBundle\\Controller\\UserController::deleteAction',  '_format' => 'json',));
                }
                not_admin_api_1_delete_user:

            }

            if (0 === strpos($pathinfo, '/api/lecturer/v1/lecturers/current')) {
                // lecturer_api_1_get_current
                if ($pathinfo === '/api/lecturer/v1/lecturers/current') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_lecturer_api_1_get_current;
                    }

                    return array (  '_controller' => 'Viettut\\Bundles\\UserSystem\\LecturerBundle\\Controller\\LecturerController::getAction',  '_format' => 'json',  '_route' => 'lecturer_api_1_get_current',);
                }
                not_lecturer_api_1_get_current:

                // lecturer_api_1_patch_current
                if ($pathinfo === '/api/lecturer/v1/lecturers/current') {
                    if ($this->context->getMethod() != 'PATCH') {
                        $allow[] = 'PATCH';
                        goto not_lecturer_api_1_patch_current;
                    }

                    return array (  '_controller' => 'Viettut\\Bundles\\UserSystem\\LecturerBundle\\Controller\\LecturerController::patchAction',  '_format' => 'json',  '_route' => 'lecturer_api_1_patch_current',);
                }
                not_lecturer_api_1_patch_current:

            }

            if (0 === strpos($pathinfo, '/api/v1')) {
                // api_get_token
                if ($pathinfo === '/api/v1/getToken') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_get_token;
                    }

                    return array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\TokenController::getTokenAction',  '_format' => 'json',  '_route' => 'api_get_token',);
                }
                not_api_get_token:

                // api_check_token
                if ($pathinfo === '/api/v1/checkToken') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_check_token;
                    }

                    return array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\TokenController::checkTokenAction',  '_format' => 'json',  '_route' => 'api_check_token',);
                }
                not_api_check_token:

                if (0 === strpos($pathinfo, '/api/v1/resetting')) {
                    // api_reset_password_send_email
                    if ($pathinfo === '/api/v1/resetting/sendEmail') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_reset_password_send_email;
                        }

                        return array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\ResetPasswordController::sendEmailAction',  '_format' => 'json',  '_route' => 'api_reset_password_send_email',);
                    }
                    not_api_reset_password_send_email:

                    // api_reset_password_reset
                    if (0 === strpos($pathinfo, '/api/v1/resetting/reset') && preg_match('#^/api/v1/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_reset_password_reset;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_reset_password_reset')), array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\ResetPasswordController::resetAction',  '_format' => 'json',));
                    }
                    not_api_reset_password_reset:

                }

                if (0 === strpos($pathinfo, '/api/v1/courses')) {
                    // api_1_get_courses
                    if ($pathinfo === '/api/v1/courses') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_1_get_courses;
                        }

                        return array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\CourseController::cgetAction',  '_format' => 'json',  '_route' => 'api_1_get_courses',);
                    }
                    not_api_1_get_courses:

                    // api_1_get_course
                    if (preg_match('#^/api/v1/courses/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_1_get_course;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_get_course')), array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\CourseController::getAction',  '_format' => 'json',));
                    }
                    not_api_1_get_course:

                    // api_1_post_course
                    if ($pathinfo === '/api/v1/courses') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_1_post_course;
                        }

                        return array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\CourseController::postAction',  '_format' => 'json',  '_route' => 'api_1_post_course',);
                    }
                    not_api_1_post_course:

                    // api_1_put_course
                    if (preg_match('#^/api/v1/courses/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_api_1_put_course;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_put_course')), array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\CourseController::putAction',  '_format' => 'json',));
                    }
                    not_api_1_put_course:

                    // api_1_patch_course
                    if (preg_match('#^/api/v1/courses/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PATCH') {
                            $allow[] = 'PATCH';
                            goto not_api_1_patch_course;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_patch_course')), array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\CourseController::patchAction',  '_format' => 'json',));
                    }
                    not_api_1_patch_course:

                    // api_1_delete_course
                    if (preg_match('#^/api/v1/courses/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_api_1_delete_course;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_1_delete_course')), array (  '_controller' => 'Viettut\\Bundles\\ApiBundle\\Controller\\CourseController::deleteAction',  '_format' => 'json',));
                    }
                    not_api_1_delete_course:

                }

            }

            // api_1_post_user
            if ($pathinfo === '/api/user/v1/users') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_1_post_user;
                }

                return array (  '_controller' => 'Viettut\\Bundles\\UserBundle\\Controller\\UserController::postAction',  '_format' => 'json',  '_route' => 'api_1_post_user',);
            }
            not_api_1_post_user:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
