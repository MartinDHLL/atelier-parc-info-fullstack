<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:"/", name:"app_")]
class TicketsController extends AbstractController
{
    #[Route('/tickets', name: 'tickets')]
    public function index(): Response
    {
        return $this->render('tickets/index.html.twig', [
            'title' => 'Tickets'
        ]);
    }
}
