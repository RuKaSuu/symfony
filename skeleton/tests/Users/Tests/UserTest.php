<?php
namespace App\Tests\Users\Tests;

use App\Entity\Jobs;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    //Create a test to check if the user is created
    public function testUser()
    {
        $user = new User();
        $user->setName('John');
        $user->setSurname('Doe');
        $user->setAge(19);
        $user->setAddress('14 rue du polisson, 95490 Vauréal');
        $user->setLevels('2');
        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);

        $this->assertSame('John', $user->getName());
        $this->assertSame('Doe', $user->getSurname());
        $this->assertSame(19, $user->getAge());
        $this->assertSame('14 rue du polisson, 95490 Vauréal', $user->getAddress());
        $this->assertSame('2', $user->getLevels());
        $this->assertSame(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL'], $user->getSkills());
    }

    public function testJobs()
    {
        $job = new Jobs();
        $job->setJobName('Développeur Web');
        $job->setJobTitle('React Native|JS Developer');
        $job->setJobDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
        $job->setJobCreator('Mark Zuckerberg');
        $job->setJobLocation('London');
        $job->setJobDegree('Master 1');

        $this->assertSame('Développeur Web', $job->getJobName());
        $this->assertSame('React Native|JS Developer', $job->getJobTitle());
        $this->assertSame('React Native or JS Developer for a web application to a mobile application with a 6 months contract', $job->getJobDescription());
        $this->assertSame('Mark Zuckerberg', $job->getJobCreator());
        $this->assertSame('London', $job->getJobLocation());
        $this->assertSame('Master 1', $job->getJobDegree());
    }
}