<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
#[Route(path:"/users", name:"app_users")]
class UserController extends AbstractController
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route('/', name: '')]
    public function show(UserRepository $userRepo): Response
    {
        $users = $userRepo->findAllTechnicians();
        return $this->render('_models/modelC.html.twig', [ // Modele C qui contient 1 seul emplacement de widget
            'title' => 'Gestion Techniciens',
            'widgetA' => 'user/show', // nom du widget A dans le dossier template '_widgets'
            'users' => $users,
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(UserRepository $userRepo, Request $request): Response
    {
        $users = $userRepo->findAllTechnicians();
        $form = $this->createForm(UserType::class, null, options:["type" => "add"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepo->save($user->setPassword($this->hasher->hashPassword($user, $form->get('password')->getData()))->setRoles(['ROLE_TECH']), true);
            return $this->redirectToRoute('app_users');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Gestion Techniciens',
            'widgetA' => 'user/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'users' => $users,
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: '_edit')]
    public function edit(User $user, UserRepository $userRepo, Request $request): Response
    {
        $users = $userRepo->findAllTechnicians();
        $form = $this->createForm(UserType::class, $user, options:["type" => "edit"])->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepo->save($user, true);
            return $this->redirectToRoute('app_users');
        }

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Gestion Techniciens',
            'widgetA' => 'user/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'form', // nom du widget B dans le dossier template '_widgets'
            'users' => $users,
            'user' => $user,
            'form' => $form
        ]);
    }

    #[Route('/detail/{id}', name: '_detail')]
    public function detail(User $user, UserRepository $userRepo): Response
    {
        $users = $userRepo->findAllTechnicians();

        return $this->render('_models/modelB.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Gestion Techniciens',
            'widgetA' => 'user/show', // nom du widget A dans le dossier template '_widgets'
            'widgetB' => 'user/detail', // nom du widget B dans le dossier template '_widgets'
            'user' => $user,
            'users' => $users
        ]);
    }

    #[Route('/remove/{id}', name: '_remove')]
    public function remove(User $user, UserRepository $userRepo): Response
    {
        $userRepo->remove($user, true);
        return $this->redirectToRoute('app_users');
    }
}