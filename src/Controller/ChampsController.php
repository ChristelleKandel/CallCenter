<?php

namespace App\Controller;

use App\Entity\Champs;
use App\Form\ChampsType;
use App\Repository\ChampsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/champs')]
class ChampsController extends AbstractController
{
    #[Route('/', name: 'app_champs_index', methods: ['GET'])]
    public function index(ChampsRepository $champsRepository): Response
    {
        return $this->render('champs/index.html.twig', [
            'champs' => $champsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_champs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChampsRepository $champsRepository): Response
    {
        $champ = new Champs();
        $form = $this->createForm(ChampsType::class, $champ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $champsRepository->save($champ, true);

            return $this->redirectToRoute('app_champs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('champs/new.html.twig', [
            'champ' => $champ,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_champs_show', methods: ['GET'])]
    public function show(Champs $champ): Response
    {
        return $this->render('champs/show.html.twig', [
            'champ' => $champ,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_champs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Champs $champ, ChampsRepository $champsRepository): Response
    {
        $form = $this->createForm(ChampsType::class, $champ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $champsRepository->save($champ, true);

            return $this->redirectToRoute('app_champs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('champs/edit.html.twig', [
            'champ' => $champ,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_champs_delete', methods: ['POST'])]
    public function delete(Request $request, Champs $champ, ChampsRepository $champsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$champ->getId(), $request->request->get('_token'))) {
            $champsRepository->remove($champ, true);
        }

        return $this->redirectToRoute('app_champs_index', [], Response::HTTP_SEE_OTHER);
    }
}
