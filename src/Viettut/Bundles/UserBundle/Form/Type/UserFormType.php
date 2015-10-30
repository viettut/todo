<?php

namespace Viettut\Bundles\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Bundles\UserBundle\Entity\User;
use Viettut\Form\Type\AbstractRoleSpecificFormType;
use FOS\UserBundle\Model\UserInterface as BaseUserInterface;

class UserFormType extends AbstractRoleSpecificFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('plainPassword')
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('company')
            ->add('phone')
            ->add('city')
            ->add('state')
            ->add('address')
            ->add('postalCode')
            ->add('country')
            ->add('settings')
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                /** @var BaseUserInterface $lecturer */
                $lecturer = $event->getData();
                $lecturer->setEnabled(true);
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => User::class,
                'validation_groups' => ['Admin', 'Default'],
            ])
        ;
    }

    public function getName()
    {
        return 'viettut_form_user_api_user';
    }
}