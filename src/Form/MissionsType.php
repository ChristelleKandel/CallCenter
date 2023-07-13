<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Champs;
use App\Entity\Statuts;
use App\Entity\Missions;
use App\Entity\Prerempli;
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
            ->add('titre', null, [
                'label' => 'Nom de la mission',
            ])
            ->add('type', Choicetype::class,[
                'choices' => [
                    'enquete' => 'Enquête',
                    'prospection' => 'Prospection',
                    'reception' => 'Réception'
                ]
            ])
            ->add('date_debut', null, [
                'label' => 'Début de la mission',
                'widget' => 'single_text',
                'by_reference' => 'true'
            ])
            ->add('date_fin', null, [
                'label' => 'Fin de la mission',
                'widget' => 'single_text',
                'by_reference' => 'true'
            ])
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
            ])
            ->add('fichier')
            ->add('user', EntityType::class, [
                'class'=>Users::class, 
                'choice_label'=>'nom', 
                'label' => 'Nom des utilisateurs',
                'expanded' => true,
                'multiple' => true,
                ])
            ->add('statuts', EntityType::class, [
                'class'=>Statuts::class,
                'choice_label'=>'type',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Choisir les statuts',
            ])
            ->add('preremplis', EntityType::class, [
                'class'=>Prerempli::class,
                'choice_label'=>'texte',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Choisir les pré-remplis',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        //     'attr' => array(
        //         'class' => 'row'),
        ]);
    }
}
