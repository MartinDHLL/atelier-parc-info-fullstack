<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Hardware;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TextType::class, [
            'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('intitule', TextType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('hardware', EntityType::class, ['class' => Hardware::class,
            
                'attr' => 
                [
                'class' =>'m-1 text-black p-1 border-2'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['action'] === 'add' ? 'Créer' : 'Modifier',
                'attr' => [
                    'class' => 'bg-green-500 hover:bg-green-800 text-white p-1 pl-4 pr-4 rounded-xl'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
            'type' => 'add'
        ]);
    }
}
