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
                'label' => 'Nom de l entreprise',
                'attr' => ['class' => 'center-align']
    ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'center-align']
    ])
            ->add('period', TextType::class, [
                'label' => 'Période',
                'attr' => ['class' => 'center-align']
    ])
            ->add('skillsacquired', TextType::class, [
                'label' => 'Compétence aquis',
                'attr' => ['class' => 'center-align']
    ])
            ->add('description', TextType::class, [
                'label' => 'Description des missions',
                'attr' => ['class' => 'center-align']
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
