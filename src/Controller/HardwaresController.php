<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:"/", name:"app_")]
class HardwaresController extends AbstractController
{
    #[Route('/hardwares', name: 'hardwares')]
    public function index(): Response
    {
        return $this->render('hardwares/index.html.twig', [
            'title' => 'Hardwares'
        ]);
    }
}
