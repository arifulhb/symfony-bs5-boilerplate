<?php

namespace App\Controller\Auth;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/auth/logout', name: 'app_auth_logout', methods: ['GET', 'HEAD'])]
    public function logout()
    {
        throw new Exception('Logged Out!');
    }
}
