<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Entreprises;
use App\Entity\Jobs;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setName('Lucas');
        $user->setSurname('Goncalves');
        $user->setAge(19);
        $user->setAddress('Vauréal');
        $user->setLevels('2');
        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);

        $user2 = new User();
        $user2->setName('Théo');
        $user2->setSurname('Landemaine');
        $user2->setAge(19);
        $user2->setAddress('Osny');
        $user2->setLevels('2');
        $user2->setSkills(['PHP', 'Symfony', 'ReactJS', 'CSS', 'JS']);


        $society = new Company();
        $society->setName('Facebook');
        $society->setPicture('https://www.facebook.com/images/fb_icon_325x325.png');
        $society->setAddress('London');
        $society->setWebsiteLink('https://www.facebook.com/');

        $society2 = new Company();
        $society2->setName('Microsoft');
        $society2->setPicture('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Microsoft_logo_-_2012_%28vertical%29.svg/1910px-Microsoft_logo_-_2012_%28vertical%29.svg.png');
        $society2->setAddress('Paris');
        $society2->setWebsiteLink('https://www.microsoft.com/fr-fr/');


        $jobs = new Jobs();
        $jobs->setTitle('React Native|JS Developer');
        $jobs->setDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
        $jobs->setLocation('London');
        $jobs->setDegree('Master 1');
        $jobs->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);
        $jobs->setCompany($society);
        $jobs->setPostDate(new \DateTime());

        $jobs2 = new Jobs();
        $jobs2->setTitle('JS Developer');
        $jobs2->setDescription('JS Developer for a web application with a 1 year contract');
        $jobs2->setLocation('Paris');
        $jobs2->setDegree('Master 2');
        $jobs2->setSkills(['PHP', 'Symfony', 'ReactJS', 'CSS', 'JS']);
        $jobs2->setCompany($society2);
        $jobs2->setPostDate(new \DateTime());




        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($jobs);
        $manager->persist($jobs2);
        $manager->persist($society);
        $manager->persist($society2);
        $manager->flush();


    }
}
