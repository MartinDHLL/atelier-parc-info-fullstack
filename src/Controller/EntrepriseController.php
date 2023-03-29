<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/entreprises", name:"app_entreprises")]
class EntrepriseController extends AbstractController
{
    #[Route('/', name: '')]
    public function show(EntrepriseRepository $entrepriseRepo): Response
    {
        $entreprises = $entrepriseRepo->findAll();
        return $this->render('_models/modelC.html.twig', [ // Modele C qui contient 1 seul emplacement de widget
            'title' => 'Entreprises',
            'widgetA' => 'entreprise/show', // nom du widget A dans le dossier template '_widgets'
            'entreprises' => $entreprises,
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(EntrepriseRepository $entrepriseRepo, Request $request): Response
    {
        $entreprises = $entrepriseRepo->findAll();
        $form = $this->createForm(EntrepriseType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entreprise = $form->getData();
            $entrepriseRepo->save($entreprise, true);
            return $this->redirectToRoute('app_entreprises');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Entreprises',
            'widgetA' => 'entreprise/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'entreprises' => $entreprises,
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: '_edit')]
    public function edit(Entreprise $entreprise, EntrepriseRepository $entrepriseRepo, Request $request): Response
    {
        $entreprises = $entrepriseRepo->findAll();
        $form = $this->createForm(EntrepriseType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entreprise = $form->getData();
            $entrepriseRepo->save($entreprise, true);
            return $this->redirectToRoute('app_entreprises');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Entreprises',
            'widgetA' => 'entreprise/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'entreprises' => $entreprises,
            'form' => $form
        ]);
    }

    #[Route('/detail/{id}', name: '_detail')]
    public function detail(Entreprise $entreprise, EntrepriseRepository $entrepriseRepo): Response
    {
        $entreprises = $entrepriseRepo->findAll();

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Entreprises',
            'widgetA' => 'entreprise/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'entreprise/detail', // nom du widget B dans le dossier template '_widgets'
            'entreprise' => $entreprise,
            'entreprises' => $entreprises
        ]);
    }

    #[Route('/remove/{id}', name: '_remove')]
    public function remove(Entreprise $entreprise, EntrepriseRepository $entrepriseRepo): Response
    {
        $entrepriseRepo->remove($entreprise, true);
        return $this->redirectToRoute('app_entreprises');
    }
}