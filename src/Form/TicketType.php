<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options['type'] === 'add' ? (
        $builder
            ->add('number')
            ->add('intitule')
            ->add('description')
            ->add('hardware')) 
        :
            ($builder
            ->add('number')
            ->add('intitule')
            ->add('description')
            ->add('hardware'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
            'type' => 'add'
        ]);
    }
}
