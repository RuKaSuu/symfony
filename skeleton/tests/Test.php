<?php
namespace App\Tests;

use App\Entity\Company;

use App\Entity\Jobs;
use App\Entity\User;
use App\Repository\CompanyRepository;
use App\Repository\JobsRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
//    public function testUser()
//    {
//        $user = new User();
//        $user->setName('John');
//        $user->setSurname('Doe');
//        $user->setAge(19);
//        $user->setAddress('14 rue du polisson, 95490 Vauréal');
//        $user->setLevels('2');
//        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);
//
//        $this->assertSame('John', $user->getName());
//        $this->assertSame('Doe', $user->getSurname());
//        $this->assertSame(19, $user->getAge());
//        $this->assertSame('14 rue du polisson, 95490 Vauréal', $user->getAddress());
//        $this->assertSame('2', $user->getLevels());
//        $this->assertSame(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL'], $user->getSkills());
//    }
//
//    public function testJobs()
//    {
//        $job = new Jobs();
//        $job->setTitle('React Native|JS Developer');
//        $job->setDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
//        $job->setLocation('London');
//        $job->setDegree('Master 1');
//
//        $this->assertSame('React Native|JS Developer', $job->getTitle());
//        $this->assertSame('React Native or JS Developer for a web application to a mobile application with a 6 months contract', $job->getDescription());
//        $this->assertSame('London', $job->getLocation());
//        $this->assertSame('Master 1', $job->getDegree());
//    }
//
//    public function testUserCreation()
//    {
//        $user = new User();
//        $user->setName('John');
//        $user->setSurname('Doe');
//        $user->setAge(19);
//        $user->setAddress('14 rue du polisson, 95490 Vauréal');
//        $user->setLevels('2');
//        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);
//
//        $userRepository = $this->createMock(UserRepository::class);
//
//        $userRepository->expects($this->once())
//            ->method('save')
//            ->with($user);
//
//        $userRepository->save($user);
//
//    }
//
//    public function testJobsCreation()
//    {
//        $society = new Company();
//        $society->setName('Facebook');
//        $society->setPicture('https://www.facebook.com/images/fb_icon_325x325.png');
//        $society->setAddress('London');
//        $society->setWebsiteLink('https://www.facebook.com/');
//
//        $job = new Jobs();
//        $job->setTitle('React Native|JS Developer');
//        $job->setDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
//        $job->setPostDate(new \DateTime());
//        $job->setLocation('London');
//        $job->setCompany($society);
//        $job->setDegree('Master 1');
//
//        $jobRepository = $this->createMock(JobsRepository::class);
//
//        $jobRepository->expects($this->once())
//            ->method('save')
//            ->with($job);
//
//        $jobRepository->save($job);
//
//    }
//
//    public function testCompanyCreation()
//    {
//        $company = new Company();
//        $company->setName('Google');
//        $company->setPicture('https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png');
//        $company->setAddress('London');
//        $company->setWebsiteLink('https://www.google.com/');
//
//        $companyRepository = $this->createMock(CompanyRepository::class);
//
//        $companyRepository->expects($this->once())
//            ->method('save')
//            ->with($company);
//
//        $companyRepository->save($company);
//
//    }

    public function testMatching(ManagerRegistry $doctrine)
    {
        $user = new User();
        $user->setName('John');
        $user->setSurname('Doe');
        $user->setAge(19);
        $user->setAddress('14 rue du polisson, 95490 Vauréal');
        $user->setLevels('2');
        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);

        $job = new Jobs();
        $job->setTitle('React Native|JS Developer');
        $job->setDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
        $job->setLocation('London');
        $job->setDegree('Master 1');

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

        $this->assertSame($jobsMatches, $user->getMatchingJobs());

    }

}