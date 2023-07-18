<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Societe;
use App\Entity\Missions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UsersFormType extends AbstractType
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
            ->add('missions', EntityType::class, [
                'class'=>Missions::class, 
                'choice_label'=>'titre', 
                'label' => 'Nom des missions auxquelles cet utilisateur a accès (ctrl clic pour choix multiple)',
                // 'expanded' => true,
                'multiple' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
