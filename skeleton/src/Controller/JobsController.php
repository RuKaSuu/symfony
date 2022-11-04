<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Jobs;
use App\Entity\User;
use App\Form\Type\JobsType;
use App\Repository\JobsRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query;

class JobsController extends AbstractController
{

    #[Route('/jobs', name: 'jobs_form')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        //get all companies
        $companies = $doctrine->getRepository(Company::class)->findAll();

        $companiesName = [];
        foreach ($companies as $company) {
            $companiesName[$company->getName()] = $company->getId();
        }

        $job = new Jobs();
        $form = $this->createForm(JobsType::class, $job, [
            'empty_data' => $companiesName
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager = $doctrine->getManager();
            $data->setPostDate(new \DateTime());
            $entityManager->persist($data);

            $entityManager->flush();

            return $this->redirectToRoute('jobs_render');

        }

        return $this->render('jobs/index.html.twig', [
            'controller_name' => 'JobsController',
            'form' => $form->createView(),
        ]);

    }


    #[Route('/jobsRender', name: 'jobs_render')]
    public function readJob(Request $request, ManagerRegistry $doctrine): Response
    {
        $jobRepository = $doctrine->getRepository(Jobs::class)->findAll();

        return $this->render('jobs/show.html.twig', [
            'jobs' => $jobRepository,
        ]);

    }

}
