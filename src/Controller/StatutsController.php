<?php

namespace App\Controller;

use App\Entity\Statuts;
use App\Form\StatutsType;
use App\Repository\StatutsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statuts')]
class StatutsController extends AbstractController
{
    #[Route('/', name: 'app_statuts_index', methods: ['GET'])]
    public function index(StatutsRepository $statutsRepository): Response
    {
        return $this->render('statuts/index.html.twig', [
            'statuts' => $statutsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statuts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutsRepository $statutsRepository): Response
    {
        $statut = new Statuts();
        $form = $this->createForm(StatutsType::class, $statut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutsRepository->save($statut, true);

            return $this->redirectToRoute('app_statuts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statuts/new.html.twig', [
            'statut' => $statut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statuts_show', methods: ['GET'])]
    public function show(Statuts $statut): Response
    {
        return $this->render('statuts/show.html.twig', [
            'statut' => $statut,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statuts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Statuts $statut, StatutsRepository $statutsRepository): Response
    {
        $form = $this->createForm(StatutsType::class, $statut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutsRepository->save($statut, true);

            return $this->redirectToRoute('app_statuts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statuts/edit.html.twig', [
            'statut' => $statut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statuts_delete', methods: ['POST'])]
    public function delete(Request $request, Statuts $statut, StatutsRepository $statutsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statut->getId(), $request->request->get('_token'))) {
            $statutsRepository->remove($statut, true);
        }

        return $this->redirectToRoute('app_statuts_index', [], Response::HTTP_SEE_OTHER);
    }
}
