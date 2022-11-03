<?php

namespace App\Controller;

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
//    #[Route('/jobCreate', name: 'jobs_create')]
//    public function createJob(ManagerRegistry $doctrine): Response
//    {
//        $entityManager = $doctrine->getManager();

//        $job = new Jobs();
//        $job->setJobTitle('React Native|JS Developer');
//        $job->setJobDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
//        $job->setJobCreator('Mark Zuckerberg');
//        $job->setJobLocation('London');
//        $job->setJobDegree('Master 1');
//        $job->setJobPostDate(new \DateTime());


//        $entityManager->persist($job);
//        $entityManager->flush();

//        return new Response('Saved new job with id ' . $job->getId());

//    }

    #[Route('/jobsNew', name: 'jobs_form')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $job = new Jobs();
        $form = $this->createForm(JobsType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager = $doctrine->getManager();
            $data->setJobPostDate(new \DateTime());
            $data->setJobTitle($data->getJobName());
            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute('jobs_render');

//            dd($data);
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

//        for ($i = 0; $i < count($jobRepository); $i++) {
//            $arr = $jobRepository[$i]->getJobSkills();
//        }
//
//        dd($arr);

        return $this->render('jobs/show.html.twig', [
            'jobs' => $jobRepository,
//            'users' => $userRepository,
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


}
