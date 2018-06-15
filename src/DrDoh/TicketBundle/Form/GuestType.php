<?php

namespace DrDoh\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextArea;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DiscountType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GuestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('birthDate', BirthdayType::class,array(
                'input' => 'datetime',
                'placeholder' => [
                    'month' => 'Mois',
                    'year' => 'Année',
                    'day' => 'Jours',],
                    'format' => 'dd MM yyyy',
            ))
            ->add('discountType', EntityType::class, array(
                'class' => "DrDohTicketBundle:Discount",
                'choice_label'=>"type",
                'multiple'=>false,
                'expanded'=>false,
            ))
            ->add('country', CountryType::class, [
                'mapped' => false,
                'required' => false,
                'preferred_choices' => [
                    'FR', 'DE', 'US', 'ES', 'GB', 'IT', 'JP',
                ],
            ])
            ->add('save', SubmitType::class);
    }/**
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
