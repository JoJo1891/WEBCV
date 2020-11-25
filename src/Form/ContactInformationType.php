<?php

namespace App\Form;

use App\Entity\ContactInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ContactInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
            ->add('numero', NumberType::class, [
                'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
            ])
            ->add('email', TextType::class, [
        'attr' => ['class' => 'materialize-text input-field col s6 offset-s3']
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactInformation::class,
        ]);
    }
}
