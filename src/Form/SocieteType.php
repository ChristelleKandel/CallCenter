<?php

namespace App\Form;

use App\Entity\Societe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocieteType extends AbstractType
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
            ->add('logo', null, [
                'label' => 'logo',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('adresse', null, [
                'label' => 'Adresse',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('code_postal', null, [
                'label' => 'Code postal',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('ville', null, [
                'label' => 'Ville',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('tel', null, [
                'label' => 'Téléphone',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('nom_contact', null, [
                'label' => 'Nom du contact',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('email', null, [
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('website', null, [
                'label' => 'Site web',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('commentaires', null, [
                'label' => 'Commentaires à afficher pour les TC',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
