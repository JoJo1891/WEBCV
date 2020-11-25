<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diplomatitle', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('school', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('city', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('yearofgraduation', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
