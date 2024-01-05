<?php

namespace App\Controller;

use App\Entity\TicketAction;
use App\Form\TicketActionType;
use App\Repository\TicketActionRepository;
use App\Repository\TicketRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted("ROLE_TECH")]
#[Route(path:'/action', name:'app_ticket_action')]
class TicketActionController extends AbstractController
{
    
    #[Route('/detail/{id}', name: '_detail')]
    public function detail(TicketAction $ticketAction, Request $request, TicketRepository $ticketRepo): Response
    {
        $ticket = $ticketRepo->find($request->get('ticket'));
        return $this->render('_models/modelB.html.twig', [
            'title' => 'Action',
            'widgetA' => 'ticket/detail',
            'widgetB' => 'ticket_action/detail',
            'ticket' => $ticket,
            'action' => $ticketAction
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(TicketActionRepository $ticketActRepo, TicketRepository $ticketRepo, Request $request): Response
    {
        $ticket = $ticketRepo->find($request->get('id'));
        $form = $this->createForm(TicketActionType::class, options:["type" => "add"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ticketAction = $form->getData();
            $ticketActRepo->save($ticketAction, true);
            return $this->redirectToRoute('app_tickets');
        }

        return $this->render('_models/modelB.html.twig', [
            'title' => 'Tickets',
            'widgetA' => 'ticket/detail', 
            'widgetB' => 'form',
            'form' => $form,
            'ticket' => $ticket
        ]);
    }

    #[Route('/edit/{id}', name: '_edit')]
    public function edit(TicketAction $ticketAction, TicketActionRepository $ticketActRepo, Request $request): Response
    {
        $ticketActShow = $ticketActRepo->findAll();
        $form = $this->createForm(TicketActionType::class,  $ticketAction, options:["type" => "edit"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ticketActShow = $form->getData();
            $ticketActRepo->save($ticketActShow, true);
            return $this->redirectToRoute('app_ticket_action');
        }

        return $this->render('_models/modelB.html.twig', [ 
            'title' => 'Tickets',
            'widgetA' => 'ticket/show', 
            'widgetB' => 'form', 
            'tickets' => $ticketActShow,
            'form' => $form
        ]);
    }

    #[Route('/remove/{id}', name: '_remove')]
    public function remove(TicketAction $ticketAction, TicketActionRepository $ticketActRepo): Response
    {
        $ticketActRepo->remove($ticketAction, true);
        return $this->redirectToRoute('app_ticket', ['id' => $ticketAction->getTicket()->getId()]);
    }
}
