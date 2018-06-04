<?php

namespace DrDoh\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName')
            ->add('firstName')
            ->add('birthDate')
            ->add('ticketId')
            ->add('reservedDate')
            ->add('bookingDate')
            ->add('discountType')
            ->add('amountPaid')
            ->add('email')
            ->add('main_guest')
            ->add('reservedDateId');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DrDoh\TicketBundle\Entity\Guest'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'drdoh_ticketbundle_guest';
    }


}
