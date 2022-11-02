<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoostrapTestController extends AbstractController
{
    #[Route('/boostrapTest', name: 'app_boostrap')]
    public function index(): Response
    {
        return $this->render('boostrapTest/index.html.twig', [
            'controller_name' => 'BoostrapTestController',
        ]);
    }
}
