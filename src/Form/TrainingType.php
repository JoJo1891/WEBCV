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
                'label' => 'Nom du diplome',
                'attr' => ['class' => 'center-align']
    ])
            ->add('school', TextType::class, [
                'label' => 'Ecole',
                'attr' => ['class' => 'center-align']
    ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'center-align']
    ])
            ->add('yearofgraduation', TextType::class, [
                'label' => 'Année d obtention',
                'attr' => ['class' => 'center-align']
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
