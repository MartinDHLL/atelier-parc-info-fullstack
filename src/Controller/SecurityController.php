<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, UserRepository $userRepo): Response
    {
        if (count($userRepo->findAllAdmins()) <= 0)
        {
            return $this->redirectToRoute('app_addAdmin');
        }

        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/addAdmin', name: 'app_addAdmin')]
    public function makeAdmin(Request $request, UserRepository $userRepo, UserPasswordHasherInterface $hasher): Response
    {
        if (count($userRepo->findAll()) > 0)
        {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserType::class)->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            if(count($userRepo->findAll()) > 0)
            {
                return $this->redirectToRoute('app_login');
            }

            $secretInput = $form->get('secret-verification')->getData();
    
            if($secretInput === $_ENV['APP_CONFIG_SECRET']) 
            {
                try {
                $admin = new User();
                $admin
                    ->setPassword($hasher->hashPassword($admin, $form->get('password')->getData()))
                    ->setName($form->get('name')->getData())
                    ->setEmail($form->get('email')->getData())
                    ->setRoles(['ROLE_TECH','ROLE_ADMIN']);
                $userRepo->save($admin, true);
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    return $this->redirectToRoute('app_login');
                }
                return $this->redirectToRoute('app_login');
            }
            return new JsonResponse(['erreur' => 'non autorisé']);
        }

        return $this->render('_models/modelC.html.twig', [ // Modele B qui contient 2 emplacements de widget
            'title' => 'Création Responsable',
            'widgetA' => 'form', // nom du widget A dans le dossier template '_widgets'
            'form' => $form
        ]);
    }
}
