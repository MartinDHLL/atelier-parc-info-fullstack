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
            ->add('email', EmailType::class, ['label' => 'email', 'attr' => ['class' => 'm-1 text-black p-1 border-2']])
            ->add('name', TextType::class, ['label' => 'nom', 'attr' => ['class' => 'm-1 text-black p-1 border-2']]);
            if($options['action'] === 'addAdmin') {
                $builder
                ->add('password', PasswordType::class, ['label' => 'mot de passe', 'attr' => ['class' => 'm-1 text-black p-1 border-2']])
                ->add('secret-verification', PasswordType::class, ['label' => 'phrase secrète', 'attr' => ['class' => 'm-1 text-black p-1 border-2']]);
            }
            if($options['action'] === 'add') {
                $builder
                ->add('password', PasswordType::class, ['label' => 'mot de passe', 'attr' => ['class' => 'm-1 text-black p-1 border-2']]);
            }
        $builder
            ->add('submit', SubmitType::class, $options['action'] === "addAdmin" || $options['action'] === "addAdmin" ? ['label' => 'Créer'] : ['label' => 'Modifier']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'action' => 'edit',
        ]);
    }
}
