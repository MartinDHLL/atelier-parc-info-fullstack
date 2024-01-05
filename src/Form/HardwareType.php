<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Hardware;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HardwareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TypeTextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('serialNum', TypeTextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class
            ])
            ->add('type')
            ->add('submit', SubmitType::class, [
                'label' => $options['type'] === 'add' ? 'Créer' : 'Modifier',
                'attr' => [
                    'class' => 'bg-green-500 hover:bg-green-800 text-white p-1 pl-4 pr-4 rounded-xl'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hardware::class,
            'type' => 'add'
        ]);
    }
}
