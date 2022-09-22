<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
class AccountController extends AbstractController
{
    #[Route('account', name: 'account', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        return $this->render('app/profile/index.html.twig', [
            'controller_name' => 'AppProfileController',
        ]);
    }
}
