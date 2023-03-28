<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HardwaresController extends AbstractController
{
    #[Route('/hardwares', name: 'app_hardwares')]
    public function index(): Response
    {
        return $this->render('hardwares/index.html.twig', [
            'controller_name' => 'HardwaresController',
        ]);
    }
}
