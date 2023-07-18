<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Societe;
use App\Entity\Missions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', null, [
            'label' => 'Nom',
            'attr' => array(
                'class' => 'form-control mb-1'
            )                
            ])
        ->add('prenom', null, [
            'label' => 'Prénom',
            'attr' => array(
                'class' => 'form-control mb-1'
            )
            ])
        ->add('roles', ChoiceType::class, [
            'choices' => [
                'TC' => 'ROLE_TC',
                'Administrateur' => 'ROLE_ADMIN',
                'client' => 'ROLE_CLIENT_VIEW',
                'client+' => 'ROLE_CLIENT_MODIF',

            ],
            'expanded' => true,
            'multiple' => true,
            'label' => 'Rôles'
        ])
        ->add('email', null, [
            'label' => 'Email',
            'attr' => array(
                'class' => 'form-control mb-1'
            )
            ])
        ->add('societe', EntityType::class, [
            'class'=>Societe::class, 
            'choice_label'=>'Nom', 
            'label' => 'Nom de la société',
            'attr' => array(
                'class' => 'form-control mb-1'
            ),
            ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Merci d\'entrer un mot de passe',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
            'invalid_message' => 'Les 2 mots de passe doivent être identiques.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label' => 'Mot de passe',
            'attr' => array(
                'class' => 'form-control mb-1'
            ) ],
            'second_options' => ['label' => 'Confirmer le mot de passe',
            'attr' => array(
                'class' => 'form-control mb-1'
            ) ],
        ])
        // ->add('createdAt')
        // ->add('modifiedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
