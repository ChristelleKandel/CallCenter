<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Societe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )
                ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
