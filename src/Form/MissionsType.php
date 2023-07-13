<?php

namespace App\Form;

use App\Entity\Missions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('type')
            ->add('date_debut')
            ->add('date_fin')
            ->add('script')
            ->add('commentaires')
            ->add('email_rdv_client_text')
            ->add('email_rdv_prospect_text')
            ->add('champs')
            ->add('rdv_date')
            ->add('fichier')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
