<?php

namespace App\Form;

use App\Entity\Statuts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatutsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', null, [
                'label' => 'Nom du type de statut',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('couleur', null, [
                'label' => 'Code couleur #xxxxx',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
            ->add('definitif', null, [
                'label' => 'Statut définitif ?',              
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statuts::class,
        ]);
    }
}
