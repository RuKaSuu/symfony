<?php

namespace App\DataFixtures;

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
        $user->setAddress('14 rue du polisson, 95490 Vauréal');
        $user->setLevels('2');
        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);

        $jobs = new Jobs();
        $jobs->setJobName('Développeur Web');
        $jobs->setJobTitle('React Native|JS Developer');
        $jobs->setJobDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
        $jobs->setJobCreator('Mark Zuckerberg');
        $jobs->setJobLocation('London');
        $jobs->setJobDegree('Master 1');
        $jobs->setJobPostDate(new \DateTime());

        $manager->persist($user);
        $manager->persist($jobs);
        $manager->flush();


    }
}
