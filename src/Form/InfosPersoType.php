<?php

namespace App\Form;

use App\Entity\InfosPerso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class InfosPersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('jobtitle', TextType::class, [
                'label' => 'Intitulé de Poste',
                'attr' => ['class' => 'validate center-align']
    ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar (PNG ou JPEG)',

                'mapped' => false,

                'required' => false,

                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/gif',
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir une image au format PNG, JPEG ou GIF',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfosPerso::class,
        ]);
    }
}
