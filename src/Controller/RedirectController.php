<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_TECH")]
#[Route(path:"/", name:"app_")]
class RedirectController extends AbstractController
{
    #[Route('', name: 'redirect_default')]
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute("app_home");
    }
}