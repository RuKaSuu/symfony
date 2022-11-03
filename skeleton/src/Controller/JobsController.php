<?php

namespace App\Controller;

use App\Entity\Jobs;
use App\Repository\JobsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsController extends AbstractController
{
    #[Route('/jobCreate', name: 'jobs_create')]
    public function createJob(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $job = new Jobs();
        $job->setJobTitle('React Native|JS Developer');
        $job->setJobDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract'); 
        $job->setJobCreator('Mark Zuckerberg');
        $job->setJobLocation('London');
        $job->setJobDegree('Master 1');
        $job->setJobPostDate(new \DateTime());        
        $job->setJobName('React Native|JS Developer');
        

        $entityManager->persist($job);
        $entityManager->flush();

        return new Response('Saved new job with id ' . $job->getId());
    
    }

    #[Route('/jobs', name: 'jobs_form')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createFormBuilder()
            ->add('jobName', TextType::class)
            ->add('jobCreator', TextType::class)
//            ->add('jobPostDate', DateType::class)
            ->add('jobDegree', TextType::class)
            ->add('jobDescription', TextType::class)
            ->add('jobTitle', TextType::class)
            ->add('jobLocation', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager = $doctrine->getManager();
            $job = new Jobs();
            $job->setJobName($data['jobName']);
            $job->setJobCreator($data['jobCreator']);
            $job->setJobPostDate(new \DateTime());
            $job->setJobDegree($data['jobDegree']);
            $job->setJobDescription($data['jobDescription']);
            $job->setJobTitle($data['jobTitle']);
            $job->setJobLocation($data['jobLocation']);
            $entityManager->persist($job);
            $entityManager->flush();

            return $this->redirectToRoute('jobs_render');

        }

        return $this->render('jobs/index.html.twig', [
            'controller_name' => 'JobsController',
            'form' => $form->createView(),
        ]);


    }
    

    #[Route('/jobsRender', name: 'jobs_render')]
    public function readJob(ManagerRegistry $doctrine): Response
    {
        $jobRepository = $doctrine->getRepository(Jobs::class)->findAll();


        return $this->render('jobs/show.html.twig', [
            'jobs' => $jobRepository,
        ]);
    }


//    job delete
    #[Route('/jobDelete/{id}', name: 'job_delete')]
    public function deleteJob(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $job = $entityManager->getRepository(Jobs::class)->find($id);

        if (!$job) {
            throw $this->createNotFoundException(
                'No job found for id ' . $id
            );
        }

        $entityManager->remove($job);
        $entityManager->flush();

        return $this->redirectToRoute('jobs_render');
    }



//    #[Route('/jobsOrderByDes', name: 'jobs_order_by_desc')]
//    public function jobByDesc(ManagerRegistry $doctrine): Response
//    {
//        $jobRepository = $doctrine->getRepository(Jobs::class)->orderBy();
//        return $this->render('jobs/index.html.twig', [
//            'jobs' => $jobRepository,
//        ]);
//    }
    
}
