<?php

namespace App\Form;

use App\Entity\ProfessionalCourse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProfessionalCourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de l entreprise',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('period', TextType::class, [
                'label' => 'Période',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('skillsacquired', TextType::class, [
                'label' => 'Compétence aquis',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('description', TextareaType::class, array(
                'label' => 'Description de votre poste',
                'attr' => array('class' => 'validate materialize-textarea'))
    )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProfessionalCourse::class,
        ]);
    }
}
