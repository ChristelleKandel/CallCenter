<?php

namespace App\Controller;

use App\Form\AccountFormType;
use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function show_account(): Response
    {
        $user = $this->getUser();
        return $this->render('account/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/edit', name: 'app_account_edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        //Je rajoute une sécurité pour que les personnes qui rallument mon ordi et sont connectés grâce au cookie rememberMe ne puissent pas accéder à ses fonctions
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // Je rajoute $user pour pré-remplir le formulaire et associer les modifications à ce user avant de l'enregistrer
        $user = $this->getUser();
        $form = $this->createForm(AccountFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $em->persist($user);
            $em->flush();
            // $this->addFlash('success', 'Fiche modifiée avec succès!');
            // OU utilisation des fichiers js et css sweetalert:
            $this->addFlash('notice', 'Votre profil a bien été mis à jour');
            return $this-> redirectToRoute('app_account');
        }
        return $this->render('account/edit_account.html.twig', [
            'user' => $user,
            'monFormulaire' => $form->createView(),
        ]);
    }

    #[Route('/password', name: 'app_account_password')]
    public function changePassword(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $PasswordEncoder): Response
    {
        //Je rajoute une sécurité pour que les personnes qui rallument mon ordi et sont connectés grâce au cookie rememberMe ne puissent pas accéder à ses fonctions
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // Je rajoute $user pour pré-remplir le formulaire et associer les modifications à ce user avant de l'enregistrer
        $user = $this->getUser();
        // createform, hérité de AbstractController, permet de passer (un type, des data, des options). Pour mettre des options et pas de data, on met null en 2eme position, on peut ainsi créer une option de toute pièce, ici un champ par défaut à false et rajouter dans des form si nécessaire. Cette option doit être ajoutée dans notre FormeType tout en bas, dans le configureOptions
        $form = $this->createForm(ChangePasswordFormType::class, null, [
            'current_password_is_required' => true,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $user->setPassword(
                $PasswordEncoder->hashPassword($user, $form['newPassword']->getData())
            );
            $em->flush();
            // $this->addFlash('success', 'Fiche modifiée avec succès!');
            // OU utilisation des fichiers js et css sweetalert:
            $this->addFlash('notice', 'Votre mot de passe a bien été modifié');
            return $this-> redirectToRoute('app_account');
        }
        return $this->render('account/change_password.html.twig',[
            'monFormulaire' => $form->createView(),
        ]);
    }

}
