<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\User;
use App\Form\Type\SocietyType;
use App\Form\Type\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
//    public function index(): Response
//    {
//        return $this->render('user/index.html.twig', [
//            'controller_name' => 'UserController',
//        ]);
//    }

    public function createBaseUser(ManagerRegistry $doctrine): Response {
        $entityManager = $doctrine->getManager();

        $baseUser = new User();
        $baseUser->setName('Lucas');
        $baseUser->setSurname('Goncalves');
        $baseUser->setAge(19);
        $baseUser->setAddress('14 rue du polisson, 95490 Vauréal');
        $baseUser->setLevels('Bac+2');

//        $createdUser = new User();
//        $createdUser->setName($name);
//        $createdUser->setSurname($surname);
//        $createdUser->setAge($age);
//        $createdUser->setAddress($address);
//        $createdUser->setLevels($levels);

        $entityManager->persist($baseUser);
//        $entityManager->persist($createdUser);

        $entityManager->flush();

        return new Response('Saved new user named :  '.$baseUser->getName());
    }

    #[Route('/user', name: 'app_user')]
    public function createUserForm(ManagerRegistry $doctrine ,Request $request): Response
    {
        $baseUser = new User();
//        $baseUser->setName('Lucas');
//        $baseUser->setSurname('Goncalves');
//        $baseUser->setAge(19);
//        $baseUser->setAddress('14 rue du polisson, 95490 Vauréal');
//        $baseUser->setLevels('Bac+2');

        $form = $this->createForm(UserType::class, $baseUser);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_display_users');

        }

        return $this->renderForm('user/index.html.twig', [
            'form' => $form,
        ]);
    }
}
