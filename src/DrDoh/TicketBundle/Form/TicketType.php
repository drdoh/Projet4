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

use Symfony\Component\Form\CallbackTransformer;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'lastName',CollectionType::class,[
                    'entry_type' => TextType::class,
                    'allow_add' => true, 
                    'allow_delete' => true,                    
                    'attr' => ['class' => 'col-md-6'],
                    'entry_options'=> [
                        'label' => 'Nom',
                        //'label_attr' => ['class' => 'col-2'],
                    ], 
                ]
            )
            ->add(
                'firstName',CollectionType::class, [
                    'entry_type' => TextType::class, 
                    'allow_add' => true, 
                    'allow_delete' => true,
                    'attr' => ['class' => 'col-md-6'],
                    'entry_options'=> [
                        'label' => 'Prénom'
                    ],   
                ]
            )
            ->add(
                'birthDate',CollectionType::class,[
                    'allow_add' => true, 
                    'allow_delete' => true,
                    'attr' => ['class' => 'col-md-4'],
                    'entry_type' => BirthdayType::class,
                    'entry_options' =>[
                        'attr' => [
                            'class' => 'datetimepicker-input',
                            'data-toggle' =>'datetimepicker',
                            'data-target'=>'#drdoh_ticketbundle_ticket_birthDate'
                        ],
                        'label'=> 'Date de naissance',
                        'input' => 'string',
                        'widget' => 'single_text',
                        'placeholder' => [
                            'month' => 'Mois',
                            'year' => 'Année',
                            'day' => 'Jours',
                        ],
                            'format' => 'dd/MM/yyyy',
                    ],
                ]
            )
            ->add(
                'country',CollectionType::class,[
                    'allow_add' => true, 
                    'allow_delete' => true,
                    'attr' => ['class' => 'col-md-4'],
                    'entry_type' => CountryType::class, 
                    'entry_options' => [
                        'label'=> 'Pays',
                        'preferred_choices' => [
                            'FR', 'DE', 'US', 'ES', 'GB', 'IT', 'JP',
                        ],
                    ]
                ]
            )
            ->add(
                'discount',CollectionType::class, [
                    'allow_add' => true, 
                    'allow_delete' => true,
                    'attr' => ['class' => 'col-md-4'],
                    'entry_type' => ChoiceType::class,
                    'entry_options' => [
                        'label'=> 'Réduction',
                        'choices'  => [
                            '' => 'none',
                            'Etudiant' => 'etude',
                            'Employé de musée'     => 'employee',
                            'Militaire'    => 'military',
                            'Ministere de la culture'    => 'ministary',
                            ],
                        ],
                ]
            )
            ->add(
                'save',SubmitType::class
            );

    }
    
    /**
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
