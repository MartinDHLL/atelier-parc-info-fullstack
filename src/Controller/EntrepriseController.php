<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/", name:"app_")]
class EntrepriseController extends AbstractController
{
    #[Route('/entreprises', name: 'entreprises')]
    public function show(): Response
    {
        return $this->render('_models/modelC.html.twig', [ // Modele C qui contient 1 seul emplacement de widget
            'title' => 'Entreprises',
            'widgetA' => 'test', // nom du widget A dans le dossier template '_widgets'
        ]);
    }
}
