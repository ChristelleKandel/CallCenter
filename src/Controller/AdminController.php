<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        // accés réservés pour cette action (mais déjà sécuriser dans config/packages/security.yaml en disant que seuls les role admin peuvent accéder aux chemins commençant par admin/):
        $this-> denyAccessUnlessGranted(attribute:'ROLE_ADMIN', message:'accès interdit');
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
