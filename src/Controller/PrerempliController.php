<?php

namespace App\Controller;

use App\Entity\Prerempli;
use App\Form\PrerempliType;
use App\Repository\PrerempliRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prerempli')]
class PrerempliController extends AbstractController
{
    #[Route('/', name: 'app_prerempli_index', methods: ['GET'])]
    public function index(PrerempliRepository $prerempliRepository): Response
    {
        return $this->render('prerempli/index.html.twig', [
            'preremplis' => $prerempliRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_prerempli_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PrerempliRepository $prerempliRepository): Response
    {
        $prerempli = new Prerempli();
        $form = $this->createForm(PrerempliType::class, $prerempli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prerempliRepository->save($prerempli, true);

            return $this->redirectToRoute('app_prerempli_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prerempli/new.html.twig', [
            'prerempli' => $prerempli,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prerempli_show', methods: ['GET'])]
    public function show(Prerempli $prerempli): Response
    {
        return $this->render('prerempli/show.html.twig', [
            'prerempli' => $prerempli,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_prerempli_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prerempli $prerempli, PrerempliRepository $prerempliRepository): Response
    {
        $form = $this->createForm(PrerempliType::class, $prerempli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prerempliRepository->save($prerempli, true);

            return $this->redirectToRoute('app_prerempli_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prerempli/edit.html.twig', [
            'prerempli' => $prerempli,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prerempli_delete', methods: ['POST'])]
    public function delete(Request $request, Prerempli $prerempli, PrerempliRepository $prerempliRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prerempli->getId(), $request->request->get('_token'))) {
            $prerempliRepository->remove($prerempli, true);
        }

        return $this->redirectToRoute('app_prerempli_index', [], Response::HTTP_SEE_OTHER);
    }
}
