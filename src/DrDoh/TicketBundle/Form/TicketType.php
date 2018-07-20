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
                'lastName',TextType::class, [
                    'label' => 'Nom',
                   // 'attr' => ['class' => 'col-md-6'],
                    //'label_attr' => ['class' => 'col-2'],
                ] 
            )
            ->add(
                'firstName',TextType::class, [
                    //'attr' => ['class' => 'col-md-6'],
                    'label' => 'Prénom'
                ]
            )
            ->add(
                'birthDate',BirthdayType::class,[
                    // 'attr' => [
                    //     'class' => 'col-md-4 datetimepicker-input',
                    //     'data-toggle' =>'datetimepicker',
                    //     'data-target'=>'#drdoh_ticketbundle_ticket_birthDate'
                    // ],
                    'label'=> 'Date de naissance',
                    'input' => 'string',
                    'widget' => 'single_text',
                    'placeholder' => [
                        'month' => 'Mois',
                        'year' => 'Année',
                        'day' => 'Jours',
                    ],
                        'format' => 'dd/MM/yyyy',
                ]
            )
            ->add(
                'country',CountryType::class,[
                        'label'=> 'Pays',
                        'preferred_choices' => [
                            'FR', 'DE', 'US', 'ES', 'GB', 'IT', 'JP',
                        ],
                        // 'attr' => ['class' => 'col-md-4'],
                ]
            )
            ->add(
                'discount',ChoiceType::class, [
                    'label'=> 'Réduction',
                    // 'attr' => ['class' => 'col-md-4'],
                    'choices'  => [
                        '' => 'none',
                        'Etudiant' => 'etude',
                        'Employé de musée'     => 'employee',
                        'Militaire'    => 'military',
                        'Ministere de la culture'    => 'ministary',
                    ],

                ]
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
