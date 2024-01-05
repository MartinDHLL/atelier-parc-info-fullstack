<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'email'])
            ->add('name', TextType::class, ['label' => 'nom']);
            if(!$options['type']) {
                $builder
                ->add('password', PasswordType::class, ['label' => 'mot de passe'])
                ->add('secret-verification', PasswordType::class, ['label' => 'phrase secrète']);
            }
            if($options['type'] === 'add') {
                $builder
                ->add('password', PasswordType::class, ['label' => 'mot de passe']);
            }
        $builder
            ->add('submit', SubmitType::class, ['label' => $options['type'] === "edit" ? 'Modifier' : "Créer"]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            /* 'data_class' => User::class, */
            'type' => null
        ]);
    }
}
