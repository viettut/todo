<?php

namespace Viettut\Bundles\UserBundle;

use Viettut\Bundles\UserBundle\DependencyInjection\Compiler\AuthenticationListenerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ViettutUserBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AuthenticationListenerCompilerPass());
    }
}
