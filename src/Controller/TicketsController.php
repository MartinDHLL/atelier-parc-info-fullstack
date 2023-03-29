<?php

namespace App\Controller;

use App\Form\TicketType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/tickets", name:"app_tickets")]
class TicketsController extends AbstractController
{
    #[Route('/', name: '')]
    public function show(TicketRepository $ticketRepo): Response
    {
        $tickets = $ticketRepo->findAll();

        return $this->render('_models/modelC.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Tickets',
            'widgetA' => 'test', // nom du widget A dans le dossier template '_widgets'
            'tickets' => $tickets
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(TicketRepository $ticketRepo, Request $request): Response
    {
        $tickets = $ticketRepo->findAll();
        $form = $this->createForm(TicketType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $ticketRepo->save($ticket, true);
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Tickets',
            'widgetA' => 'ticket/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'tickets' => $tickets,
            'form' => $form
        ]);
    }
}
