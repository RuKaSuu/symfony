<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\Type\CompanyType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    #[Route('/company/create', name: 'app_company')]
    public function createCompanyForm(ManagerRegistry $doctrine ,Request $request): Response
    {
        $baseCompany = new Company();
//        $baseUser->setName('Lucas');
//        $baseUser->setSurname('Goncalves');
//        $baseUser->setAge(19);
//        $baseUser->setAddress('14 rue du polisson, 95490 Vauréal');
//        $baseUser->setLevels('Bac+2');

        $form = $this->createForm(CompanyType::class, $baseCompany);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $company = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('company_render');

        }

        return $this->renderForm('company/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/companies', name: 'company_render')]
    public function readCompany(Request $request, ManagerRegistry $doctrine): Response
    {
        $companies = $doctrine->getRepository(Company::class)->findAll();


        return $this->render('company/show.html.twig', [
            'companies' => $companies,
        ]);

    }
}
