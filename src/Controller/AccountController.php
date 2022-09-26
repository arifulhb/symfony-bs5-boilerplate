<?php

namespace App\Controller;

use App\Form\AccountFormType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[Route('/', name: 'app_')]
class AccountController extends AbstractController
{
    #[Route('account', name: 'account', methods: ['GET', 'POST', 'HEAD'])]
    public function index(Request $request, ManagerRegistry $managerRegistry, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AccountFormType::class, $user, [
            'action' => $this->generateUrl('app_account')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $managerRegistry->getManager();
            $slugger = new AsciiSlugger();

            $authUser = $this->getUser();
            $userData = $form->getData();

            $user = $userRepository->findOneBy(['email' => $authUser->getEmail()]);

            $user->setFirstName($userData->getFirstName());
            $user->setLastName($userData->getLastName());
            $user->setHandle($slugger->slug($userData->getHandle())->lower());

            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView(),
            'title' => 'Profile'
        ]);
    }
}
