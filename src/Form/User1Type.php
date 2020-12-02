<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'validate center-align']])
            ->add('roles', TextType::class, [
                'label' => 'Role',
                'attr' => ['class' => 'validate center-align']])
            ->add('password', TextType::class, [
                'label' => 'Mot de passe',
                'attr' => ['class' => 'validate center-align']])
            ->add('name', TextType::class, [
                'label' => 'Pseudo',
                'attr' => ['class' => 'validate center-align']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
