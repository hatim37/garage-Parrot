<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '255',
                ],
                'label' => 'Nom et Prénom',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'required' => true,
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('note', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=> false,
                'label'=> 'Note' ,
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('isApproved',HiddenType::class, [

                'required'=> false,
                'label'=> false,
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Valider',
                ]);

                // On utilise un écouteur d'évenement pour verifier si nous sommes en mode édition, 
                // Si c'est le cas nous ajoutons le champ isApprouved pour pouvoir être modifié
                $builder->get('name')->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

                   $form = $event->getForm();
                    
                    //on vérifie si les champs sont déjà remplis
                    $name = $event->getForm()->getParent()->getData()->getName();
                    $message = $event->getForm()->getParent()->getData()->getMessage();
                    $note = $event->getForm()->getParent()->getData()->getNote();

                    // Si les 3 champs sont remplis, donc nous sommes en mode édition
                    if ( $name && $message && $note) {
                       //On remplace le champ "isApproved" en ajoutant le choix, 
                       $form->getParent()->add('isApproved',ChoiceType::class, [
                           'choices'  => [
                               'En attente' => 'En attente',
                               'Oui' => 'Oui',
                               'Non' => 'Non',
                           ],
                           'attr' => [
                               'class' => 'form-control',
                           ],
                           'required'=> false,
                           'label'=> 'Approuvé',
                           'label_attr' => [
                               'class' => 'form-label mt-4',
                           ]
                           ]);
                   }
                });   
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'label' => false,
        ]);
    }
}

