<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:00 PM
 */

namespace Viettut\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Entity\Core\Course;
use Viettut\Model\Core\CourseInterface;
use Viettut\Utilities\StringFactory;

class CourseFormType extends AbstractRoleSpecificFormType
{
    use StringFactory;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('introduce')
            ->add('imagePath')
            ->add('active')
            ->add('chapters', 'collection',  array(
                    'mapped' => true,
                    'type' => new ChapterFormType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                )
            )
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var CourseInterface $course */
                $course = $event->getData();
                if($course->getId() === null){
                    $course->setActive(false);
                }
                $course->setHashTag($this->getUrlFriendlyString($course->getTitle()));
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Course::class,
                'cascade_validation' => true,
            ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_course';
    }
}