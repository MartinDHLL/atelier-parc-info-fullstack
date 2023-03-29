<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/", name:"app_")]
class HardwaresController extends AbstractController
{
    #[Route('/hardwares', name: 'hardwares')]
    public function index(): Response
    {
        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Hardwares',
            'widgetA' => 'test', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'test', // nom du widget B dans le dossier template '_widgets'
            'widgetC' => 'test', // nom du widget C dans le dossier template '_widgets'
        ]);
    }
}
