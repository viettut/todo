<?php

/**
 * This file is part of the RollerworksMultiUserBundle package.
 *
 * (c) 2013 Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Bundle\MultiUserBundle\Command;

use FOS\UserBundle\Command\DemoteUserCommand as BaseDemoteUserCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Rollerworks\Bundle\MultiUserBundle\Model\UserDiscriminatorInterface;

/**
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class DemoteUserCommand extends BaseDemoteUserCommand
{
    protected function configure()
    {
        parent::configure();

        $definition = new InputDefinition();
        $definition->setDefinition(array(
            new InputArgument('username', InputArgument::REQUIRED, 'The username'),
            new InputArgument('role', InputArgument::OPTIONAL, 'The role'),
            new InputOption('user-system', null, InputOption::VALUE_REQUIRED, 'The user-system to use'),
            new InputOption('super', null, InputOption::VALUE_NONE, 'Instead specifying role, use this to quickly add the super administrator role'),
        ));

        $this->setDefinition($definition);

        $this
            ->setHelp(<<<EOT
The <info>fos:user:demote</info> command demotes a user by removing a role

  <info>php app/console fos:user:demote --user-system=acme_user matthieu ROLE_CUSTOM</info>
  <info>php app/console fos:user:demote --user-system=acme_user --super matthieu</info>
EOT
            );
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        /** @var UserDiscriminatorInterface $discriminator */
        $discriminator = $this->getContainer()->get('rollerworks_multi_user.user_discriminator');
        $discriminator->setCurrentUser($input->getOption('user-system'));

        parent::interact($input, $output);
    }
}
