<?php

namespace App\Form;

use App\Entity\Prerempli;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrerempliType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texte', null, [
                'label' => 'Texte du pré-rempli',
                'attr' => array(
                    'class' => 'form-control mb-1'
                )                
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prerempli::class,
        ]);
    }
}
