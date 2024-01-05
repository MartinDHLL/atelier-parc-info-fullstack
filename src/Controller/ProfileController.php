<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/profile", name:"app_profile")]
class ProfileController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(): Response
    {
        return $this->render('_models/modelC.html.twig', [
            'title' => 'Profil',
            'widgetA' => 'profile/show',
        ]);
    }

    #[Route('/edit', name: '_edit')]
    public function edit(Request $request, UserInterface $user, UserRepository $userRepo): Response
    {
        $form = $this->createForm(UserType::class, $user, options:["type" => "edit"])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepo->save($user, true);

            $this->addFlash('success', 'Votre profil a été modifiée avec succès!');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('_models/modelB.html.twig', [
            'title' => 'Profil',
            'form_title' => "Modification des informations de mon profil",
            'widgetA' => 'profile/show',
            'widgetB' => 'form',
            'form' => $form
        ]);
    }
}
