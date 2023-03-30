<?php

namespace App\Controller;

use App\Entity\Hardware;
use App\Form\HardwareType;
use App\Repository\HardwareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/hardwares", name:"app_hardwares")]
class HardwaresController extends AbstractController
{
    #[Route('/', name: '')]
    public function show(HardwareRepository $hardwareRepo): Response
    {
        $hardwares = $hardwareRepo->findAll();
        return $this->render('_models/modelC.html.twig', [ // Modele C qui contient 1 seul emplacement de widget
            'title' => 'Matériel',
            'widgetA' => 'hardware/show', // nom du widget A dans le dossier template '_widgets'
            'hardwares' => $hardwares,
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(HardwareRepository $hardwareRepo, Request $request): Response
    {
        $hardwares = $hardwareRepo->findAll();
        $form = $this->createForm(HardwareType::class, options:["action" => "add"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hardware = $form->getData();
            $hardwareRepo->save($hardware, true);
            return $this->redirectToRoute('app_hardwares');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Matériel',
            'widgetA' => 'hardware/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'hardwares' => $hardwares,
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: '_edit')]
    public function edit(Hardware $hardware, HardwareRepository $hardwareRepo, Request $request): Response
    {
        $hardwares = $hardwareRepo->findAll();
        $form = $this
            ->createForm(HardwareType::class, $hardware, options:["action" => "edit"])
            ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hardware = $form->getData();
            $hardwareRepo->save($hardware, true);
            return $this->redirectToRoute('app_hardwares');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Matériel',
            'widgetA' => 'hardware/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'hardwares' => $hardwares,
            'hardware' => $hardware,
            'form' => $form
        ]);
    }

    #[Route('/detail/{id}', name: '_detail')]
    public function detail(Hardware $hardware, HardwareRepository $hardwareRepo): Response
    {
        $hardwares = $hardwareRepo->findAll();

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Matériel',
            'widgetA' => 'hardware/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'hardware/detail', // nom du widget B dans le dossier template '_widgets'
            'hardware' => $hardware,
            'hardwares' => $hardwares
        ]);
    }

    #[Route('/remove/{id}', name: '_remove')]
    public function remove(Hardware $hardware, HardwareRepository $hardwareRepo): Response
    {
        $hardwareRepo->remove($hardware, true);
        return $this->redirectToRoute('app_hardwares');
    }
}
