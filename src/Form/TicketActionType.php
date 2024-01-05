<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Issue;
use App\Entity\Statut;
use App\Entity\Ticket;
use App\Entity\TicketAction;
use DateTime;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class TicketActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TypeTextType
            ::class, [
                'attr' => [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('description' , TextareaType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('temps' , NumberType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('priorite' , NumberType::class, [
                'attr' => 
                [
                    'class' => 'm-1 text-black p-1 border-2'
                ]
            ])
            ->add('createdAt' ,  DateTimeType::class, [
                'input' => 'datetime_immutable',
                'data' => new DateTimeImmutable('now')
            ])
            ->add('updatedAt' ,  DateTimeType::class, [
                'input' => 'datetime_immutable',
                'data' => new DateTimeImmutable('now')
            ])
            ->add('ticket' , EntityType::class, ['class' => Ticket::class,
            
                'attr' => 
                [
                    'class' =>'m-1 text-black p-1 border-2'
                ]
            ])
            ->add('user' , EntityType::class, ['class' => User::class,
            
                'attr' => 
                [
                    'class' =>'m-1 text-black p-1 border-2'
                ]
            ])
            ->add('issue' , EntityType::class, ['class' => Issue::class,
            
                'attr' => 
                [
                    'class' =>'m-1 text-black p-1 border-2'
                ]
            ])
            ->add('statut', EntityType::class, ['class' => Statut::class,
            
                'attr' => 
                [
                    'class' =>'m-1 text-black p-1 border-2'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['type'] === 'add' ? 'Créer' : 'Modifier',
                'attr' => [
                    'class' => 'bg-green-500 hover:bg-green-800 text-white p-1 pl-4 pr-4 rounded-xl'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TicketAction::class,
            'type' => "add"
        ]);
    }
}
