<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Champs;
use App\Entity\Societe;
use App\Entity\Statuts;
use App\Entity\Missions;
use App\Entity\Prerempli;
use App\Entity\TypeMission;
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
            ->add('type', Entitytype::class,[
                'class'=>TypeMission::class, 
                'choice_label'=>'type', 
                'label' => 'Type de mission'
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
            ->add('societe', Entitytype::class,[
                'class'=>Societe::class, 
                'choice_label'=>'nom', 
                'label' => 'Société commanditaire de la mission'
            ])
            ->add('user', EntityType::class, [
                'class'=>Users::class, 
                'choice_label'=>'nom', 
                'label' => 'Nom des clients ayant accès à cette mission (ctrl clic pour choix multiple)',
                // 'expanded' => true,
                'multiple' => true,
                ])
                ->add('commentaires', null, [
                    'label' => 'Commentaires de la mission à afficher avant le script'
                ])
            ->add('script', null, [
                'label' => 'Script pour les TC, avec {{user.nom}} pour le nom TC et {{prospect.nom}} pour le nom du prospect'
            ])
            ->add('email_rdv_client_text', null, [
                'label' => 'Texte de l\'email à envoyer au client pour lui signaler un RDV pris'
            ])
            ->add('email_rdv_prospect_text', null, [
                'label' => 'Texte de l\'email à envoyer au prospect pour lui confirmer le RDV'
            ])
            ->add('fichier', null, [
                'label' => 'Fichier(s) à expédier au prospect (séparés les noms par une virgule si plusieurs fichiers)'
            ])
            ->add('champs', EntityType::class, [
                'class'=>Champs::class,
                'choice_label'=>'nom_champ',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Choisir les champs',
            ])
            ->add('statuts', EntityType::class, [
                'class'=>Statuts::class,
                'choice_label'=>'type',
                'multiple' => true,
                // 'expanded' => true,
                'label' => 'Sélectionner les statuts pour cette mission (ctrl clic)',
                'choice_attr' => [
                    '0' => ['data-color' => "monViolet"],
                    '1' => ['data-color' => "monOrange"],
                    '2' => ['data-color' => 'monVert'],
                    '3' => ['data-color' => "monViolet"]
                ]
            ])
            ->add('preremplis', EntityType::class, [
                'class'=>Prerempli::class,
                'choice_label'=>'texte',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Sélectionner les pré-remplis pour cette mission (ctrl clic)',
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
