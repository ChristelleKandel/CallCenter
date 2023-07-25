<?php

namespace App\Form;

use App\Entity\Champs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChampsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_champ')
            ->add('label')
            ->add('type_champ')
            ->add('nullable')
            ->add('extras')
            ->add('visibleForm')
            ->add('modifiableClient')
            ->add('position')
            ->add('triable')
            ->add('obligatoire')
            ->add('multiple')
            ->add('valueMultiple')
            ->add('missions')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Champs::class,
        ]);
    }
}
