<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Champs;
use App\Entity\Missions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('champs', EntityType::class, [
                'class'=>Champs::class,
                'choice_label'=>'nom_champ',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Choisir les champs',
                'attr' => array(
                    'class' => 'form-control mb-1'
                ),
            ])
            ->add('rdv_date')
            ->add('fichier')
            ->add('user', EntityType::class, [
                'class'=>Users::class, 
                'choice_label'=>'nom', 
                'label' => 'Nom des utilisateurs',
                'expanded' => true,
                'multiple' => true,
                'attr' => array(
                    'class' => 'form-control mb-1'
                ),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
