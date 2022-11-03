<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class DisplayUsersController extends AbstractController
{
    #[Route('/display/users', name: 'app_display_users')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $userRepository = $doctrine->getRepository(User::class)->findAll();

        return $this->render('display_users/index.html.twig', [
            'users' => $userRepository,
        ]);
    }

}
