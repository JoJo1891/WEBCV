<?php

namespace App\Form;

use App\Entity\ProfessionalCourse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfessionalCourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('city', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('period', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('skillsacquired', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('description', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProfessionalCourse::class,
        ]);
    }
}
