<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('codePostal', NumberType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('telephone', NumberType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['type'] === 'add' ? 'Créer' : 'Modifier',
                'attr' => [
                    'class' => 'bg-green-500 hover:bg-green-800 text-white p-1 pl-4 pr-4 rounded-xl'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
            'type' => 'add'
        ]);
    }
}
