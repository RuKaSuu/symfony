<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\Jobs;
use App\Form\Type\SocietyType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocietyController extends AbstractController
{
    #[Route('/society', name: 'app_society')]
    public function createSocietyForm(ManagerRegistry $doctrine ,Request $request): Response
    {
        $baseSociety = new Entreprises();
//        $baseUser->setName('Lucas');
//        $baseUser->setSurname('Goncalves');
//        $baseUser->setAge(19);
//        $baseUser->setAddress('14 rue du polisson, 95490 Vauréal');
//        $baseUser->setLevels('Bac+2');

        $form = $this->createForm(SocietyType::class, $baseSociety);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $society = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($society);
            $entityManager->flush();

            return $this->redirectToRoute('society_render');

        }

        return $this->renderForm('society/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/societyRender', name: 'society_render')]
    public function readSociety(Request $request, ManagerRegistry $doctrine): Response
    {
        $societies = $doctrine->getRepository(Entreprises::class)->findAll();


        return $this->render('society/show.html.twig', [
            'societies' => $societies,
        ]);

    }
}
