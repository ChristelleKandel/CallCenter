<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Conges;
use App\Form\UserType;
use App\Form\UsersType;
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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/users')]
class UsersController extends AbstractController
{
    //L'index de TOUS les utilisateurs 
    #[Route('/', name: 'app_users', methods: ['GET'])]
    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé(e) à accéder à cette page")
     */
    public function index(UsersRepository $usersRepository): Response
    {
        // par défaut retourne la liste de tous les salariés triés par date d’arrivée descendante.
        return $this->render('users/liste.html.twig', [
            'users' => $usersRepository->findBy([], ['nom' => 'desc']),
            'clients' => $usersRepository->findByTeam(1),
            'internes' => $usersRepository->findByTeam(2),
        ]);
    }

    #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher,UsersRepository $usersRepository): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $usersRepository->save($user, true);

            return $this->redirectToRoute('app_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(Users $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_users_fiche', methods: ['GET', 'POST'])]
    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé(e) à accéder à cette page")
     */
    public function edit(Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        $form = $this->createForm(UsersFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $em->persist($user);
            // $em->flush();
            $usersRepository->save($user, true);
            //$this->addFlash('success', 'Fiche modifiée avec succès!');
            // OU utilisation des fichiers js et css sweetalert:
            $this->addFlash('notice', 'Le profil a bien été mis à jour');

            return $this->redirectToRoute('app_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/ficheUser.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_users_delete', methods: ['POST'])]
    public function delete(Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $usersRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }
}
