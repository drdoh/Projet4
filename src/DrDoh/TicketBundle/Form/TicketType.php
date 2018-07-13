<?php

namespace DrDoh\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'lastName',CollectionType::class, [
                    'label'=> 'Nom',
                    'entry_type' => TextType::class, 
                    'allow_add' => true, 
                    'allow_delete' => true                    
                ]
            )
            ->add('firstName',CollectionType::class, [
                    'label'=> 'Prénom',
                    'entry_type' => TextType::class, 
                    'allow_add' => true, 
                    'allow_delete' => true  
                    ])
            ->add('birthDate',CollectionType::class, [
                'label'=> 'Date de naissance',
                'allow_add' => true, 
                'allow_delete' => true,
                'entry_type' => BirthdayType::class,
                'entry_options' =>[
                    'input' => 'datetime',
                    'placeholder' => [
                        'month' => 'Mois',
                        'year' => 'Année',
                        'day' => 'Jours',],
                        'format' => 'dd MM yyyy',
                    ],
                ])
            ->add('country',CollectionType::class, [
                'label'=> 'Pays',
                'allow_add' => true, 
                'allow_delete' => true,
                'entry_type' => CountryType::class, 
                'entry_options' => [
                    'mapped' => true,
                    'required' => false,
                    'preferred_choices' => [
                        'FR', 'DE', 'US', 'ES', 'GB', 'IT', 'JP',
                        ],
                    ]
                ])
            ->add('discount',CollectionType::class, [
                'label'=> 'Réduction',
                'allow_add' => true, 
                'allow_delete' => true,
                'entry_type' => ChoiceType::class,
                'entry_options' => array(
                    'choices'  => array(
                        '' => 'none',
                        'Etudiant' => 'etude',
                        'Employé de musée'     => 'employee',
                        'Militaire'    => 'military',
                        'Ministere de la culture'    => 'ministary',
                        ),
                    ),
            ])
            ->add('save', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DrDoh\TicketBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'drdoh_ticketbundle_ticket';
    }


}
