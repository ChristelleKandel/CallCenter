<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Conges;
use App\Form\UserType;
use App\Data\SearchData;
use App\Form\NewUserType;
use App\Form\AbsencesType;
use App\Form\UsersFormType;
use App\Form\SearchFormType;
use App\Entity\Accompagnement;
use App\Form\DemandeCongesType;
use App\Services\MailerService;
use App\Form\RegistrationFormType;
use App\Form\ValidationCongesType;
use App\Repository\UsersRepository;
use App\Repository\CongesRepository;
use App\Repository\AbsencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RecuperationsRepository;
use App\Repository\AccompagnementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController2 extends AbstractController
{
    //L'index de TOUS les utilisateurs 
    #[Route('/users', name: 'app_users')]
    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé(e) à accéder à cette page")
     */
    public function index(UsersRepository $repo, Request $request, EntityManagerInterface $em): Response
    { 
        // par défaut retourne la liste de tous les salariés triés par date d’arrivée descendante.
        return $this->render('users/liste.html.twig', [
            'users' => $repo->findBy([], ['nom' => 'desc']),
        ]);
    }
    
    //Formulaire de modification d'un compte user 
    #[Route('/users/{id}/edit', name: 'app_users_fiche', priority:-1)]
    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé(e) à accéder à cette page")
     */
    public function createFiche(Users $user, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UsersFormType::class, $user);
        $form->handleRequest($request);
        // dd($form);
        // $echo = "test";
        if ($form->isSubmitted() && $form->isValid()) { 
            // dd($echo);
            $em->persist($user);
            $em->flush();
            //$this->addFlash('success', 'Fiche modifiée avec succès!');
            // OU utilisation des fichiers js et css sweetalert:
            $this->addFlash('notice', 'Le profil a bien été mis à jour');
            return $this-> redirectToRoute('app_users');
        }
        return $this->render('users/ficheUser.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }
}
