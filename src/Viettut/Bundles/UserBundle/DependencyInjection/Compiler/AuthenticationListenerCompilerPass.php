<?php
namespace Viettut\Bundles\UserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AuthenticationListenerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('rollerworks_multi_user.listener.authentication');
        $definition->setClass($container->getParameter('viettut_user.request.user_system.authentication_listener.class'));
    }
} 