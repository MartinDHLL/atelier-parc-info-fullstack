<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\TicketAction;
use App\Form\TicketActionType;
use App\Repository\TicketActionRepository;
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
    public function detail(/* TicketAction $ticketAction */TicketActionRepository $ticketActRepo): Response
    {
        $ticketActShow = $ticketActRepo->findAll();

        return $this->render('_models/modelB.html.twig', [
            'title' => 'Action',
            'widgetA' => 'ticket_action/show',
            'widgetB' => 'ticket_action/detail',/* 
            'action' => $ticketAction, */
            'actions' => $ticketActShow
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(TicketActionRepository $ticketActRepo, Request $request): Response
    {
        $ticketActShow = $ticketActRepo->findAll();
        $form = $this->createForm(TicketActionType::class, null, options:["action" => "add"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ticketAction = $form->getData();
            $ticketActRepo->save($ticketAction, true);
            return $this->redirectToRoute('app_ticket');
        }

        return $this->render('_models/modelB.html.twig', [
            'title' => 'Tickets',
            'widgetA' => 'ticket/show', 
            'widgetB' => 'form', 
            'tickets' => $ticketActShow,
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: '_edit')]
    public function edit(TicketAction $ticketAction, TicketActionRepository $ticketActRepo, Request $request): Response
    {
        $ticketActShow = $ticketActRepo->findAll();
        $form = $this->createForm(TicketActionType::class,  $ticketAction, options:["action" => "edit"])->handleRequest($request);
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
