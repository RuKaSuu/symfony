<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Jobs;
use App\Entity\User;
use App\Form\Type\JobsType;
use App\Repository\JobsRepository;
use DateTime;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
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

       for ($i = 0; $i < count($jobRepository); $i++) {
           $arr = $jobRepository[$i]->getJobSkills();
       }

//       dd($arr);

       return $this->render('jobs/show.html.twig', [
           'jobs' => $jobRepository,
//           'users' => $userRepository,
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


    #[Route('/jobsRenderMatch', name: 'jobs_render')]
    public function readJobMatch(ManagerRegistry $doctrine): Response
    {

        $jobs = $doctrine->getRepository(Jobs::class)->findAll();
        $users = $doctrine->getRepository(User::class)->findAll();

        $jobsMatches = [];



        foreach ($users as $user) {
            $jobsMatches[] = $user->getId();
            $jobsMatches[$user->getId()] = [];

            foreach ($jobs as $job) {
                if (array_intersect($user->getSkills(), $job->getSkills())) {
                    $jobsMatches[$user->getId()][] = $job;
                }
            }
        }


        return $this->render('jobs/debug.html.twig', [
            'jobs' => $jobs,
            'users' => $users,
            'jobsMatches' => $jobsMatches,
        ]);

    }

}
