<?php

namespace App\DataFixtures;

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

        $manager->persist($user);
        $manager->flush();
    }
}
