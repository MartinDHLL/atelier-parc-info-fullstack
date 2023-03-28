<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/", name:"app_")]
class TicketsController extends AbstractController
{
    #[Route('/tickets', name: 'tickets')]
    public function index(): Response
    {
        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Tickets',
            'widgetA' => 'ticketsShow', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'ticketsShow', // nom du widget B dans le dossier template '_widgets'
        ]);
    }
}
