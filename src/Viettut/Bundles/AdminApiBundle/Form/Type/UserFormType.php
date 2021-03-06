<?php

namespace Viettut\Bundles\AdminApiBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Bundles\UserBundle\Entity\User;
use Viettut\Form\Type\AbstractRoleSpecificFormType;
use Viettut\Model\User\Role\AdminInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

class UserFormType extends AbstractRoleSpecificFormType
{
    public function __construct(UserEntityInterface $userRole)
    {
        $this->setUserRole($userRole);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('plainPassword')
            ->add('name')
            ->add('professional')
            ->add('company')
            ->add('email')
            ->add('phone')
            ->add('city')
            ->add('state')
            ->add('address')
            ->add('postalCode')
            ->add('country')
            ->add('settings')
        ;

        if($this->userRole instanceof AdminInterface){
            $builder
                ->add('enabled')
            ;
        }

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                /**
                 * @var LecturerInterface $lecturer
                 */
                $lecturer = $event->getData();
                $hash = md5(trim($lecturer->getEmail()));
                $lecturer->setAvatar(sprintf('http://gravatar.com/avatar/%s?size=64&d=identicon', $hash));
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
        return 'viettut_form_admin_api_user';
    }
}