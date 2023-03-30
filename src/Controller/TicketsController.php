<?php

namespace App\Controller;

use App\Entity\Ticket;
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
            'widgetA' => 'ticket/show', // nom du widget A dans le dossier template '_widgets'
            'tickets' => $tickets
        ]);
    }

    #[Route('/detail/{id}', name: '_detail')]
    public function detail(Ticket $ticket, TicketRepository $ticketRepo): Response
    {
        $tickets = $ticketRepo->findAll();

        return $this->render('_models/modelB.html.twig', [
            'title' => 'Tickets',
            'widgetA' => 'ticket/show',
            'widgetB' => 'ticket/detail',
            'ticket' => $ticket,
            'tickets' => $tickets
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/edit/{id}', name: '_edit')]
    public function edit(Ticket $ticket, TicketRepository $ticketRepo, Request $request): Response
    {
        $tickets = $ticketRepo->findAll();
        $form = $this->createForm(TicketType::class, $ticket, options:["action" => "edit"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ticketRepo->save($ticket, true);
            return $this->redirectToRoute('app_tickets');
        }

        return $this->render('_models/modelB.html.twig', [ 
            'title' => 'Tickets',
            'widgetA' => 'ticket/show', 
            'widgetB' => 'form', 
            'tickets' => $tickets,
            'ticket' => $ticket,
            'form' => $form
        ]);
    }

    /* #[Route('/add', name: '_add')]
    public function add(TicketRepository $ticketRepo, Request $request): Response
    {
        $tickets = $ticketRepo->findAll();
        $form = $this->createForm(TicketType::class, null, options:["action" => "add"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $ticketRepo->save($ticket, true);
            return $this->redirectToRoute('app_tickets');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Tickets',
            'widgetA' => 'ticket/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'tickets' => $tickets,
            'form' => $form
        ]);
    } */

    /* 
    #[Route('/remove/{id}', name: '_remove')]
    public function remove(Ticket $ticket, TicketRepository $ticketRepo): Response
    {
        $ticketRepo->remove($ticket, true);
        return $this->redirectToRoute('app_tickets');
    } */
}
