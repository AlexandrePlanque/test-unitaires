<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix')
//            ->add('tarif')
            ->add('tarif', TarifType::class)
//            ->add('client')
            ->add('client', ClientType::class)
            ->add('zone', ZoneType::class)
//            ->add('billeterie')
            ->add('Mise à jour', SubmitType::class, array('label' => 'Edition'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
