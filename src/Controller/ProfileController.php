<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/", name:"app_")]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(): Response
    {
        return $this->render('_models/modelC.html.twig', [ // // Modele C qui contient 1 seul emplacement de widget
            'title' => 'Profile',
            'widgetA' => 'ticketsShow', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'ticketsShow', // nom du widget B dans le dossier template '_widgets'
            'widgetC' => 'ticketsShow', // nom du widget C dans le dossier template '_widgets'
        ]);
    }
}
