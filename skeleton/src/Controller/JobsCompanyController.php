<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Jobs;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsCompanyController extends AbstractController
{
    #[Route('/company/{id}', name: 'app_jobs_company')]
    public function readJob(Request $request, ManagerRegistry $doctrine): Response
    {

        $jobs = $doctrine->getRepository(Jobs::class)->findAll();

        $test = [];

        //push in $test array
        foreach ($jobs as $job) {
            if ($job->getCompany()->getId() == $request->get('id')) {
                array_push($test, $job);
            }
        }

        $company = $doctrine->getRepository(Company::class)->find($request->get('id'));

        return $this->render('jobs_company/index.html.twig', [
            'jobsCompany' => $test,
            'companyName' => $company,
        ]);

    }
}
