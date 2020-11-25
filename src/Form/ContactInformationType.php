<?php

namespace App\Form;

use App\Entity\ContactInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse', TextType::class, [
                'label' => 'Votre adresse : XXXXXXXX, CodePostale, Ville',
                'attr' => ['class' => 'center-align']
    ])
            ->add('numero', NumberType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => ['class' => 'center-align']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'attr' => ['class' => 'center-align']
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
