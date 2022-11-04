<?php
namespace App\Tests;

use App\Entity\Entreprises;
use App\Entity\Jobs;
use App\Entity\User;
use App\Repository\EntreprisesRepository;
use App\Repository\JobsRepository;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
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
        $job->setName('Développeur Web');
        $job->setTitle('React Native|JS Developer');
        $job->setDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
        $job->setCreator('Mark Zuckerberg');
        $job->setLocation('London');
        $job->setDegree('Master 1');

        $this->assertSame('Développeur Web', $job->getName());
        $this->assertSame('React Native|JS Developer', $job->getTitle());
        $this->assertSame('React Native or JS Developer for a web application to a mobile application with a 6 months contract', $job->getDescription());
        $this->assertSame('Mark Zuckerberg', $job->getCreator());
        $this->assertSame('London', $job->getLocation());
        $this->assertSame('Master 1', $job->getDegree());
    }

    public function testUserCreation()
    {
        $user = new User();
        $user->setName('John');
        $user->setSurname('Doe');
        $user->setAge(19);
        $user->setAddress('14 rue du polisson, 95490 Vauréal');
        $user->setLevels('2');
        $user->setSkills(['PHP', 'Symfony', 'HTML', 'CSS', 'JS', 'SQL']);

        $userRepository = $this->createMock(UserRepository::class);

        $userRepository->expects($this->once())
            ->method('save')
            ->with($user);

        $userRepository->save($user);

    }

    public function testJobsCreation()
    {
        $job = new Jobs();
        $job->setName('Développeur Web');
        $job->setTitle('React Native|JS Developer');
        $job->setDescription('React Native or JS Developer for a web application to a mobile application with a 6 months contract');
        $job->setCreator('Mark Zuckerberg');
        $job->setPostDate(new \DateTime());
        $job->setLocation('London');
        $job->setDegree('Master 1');

        $jobRepository = $this->createMock(JobsRepository::class);

        $jobRepository->expects($this->once())
            ->method('save')
            ->with($job);

        $jobRepository->save($job);

    }

    public function testCompanyCreation()
    {
        $company = new Entreprises();
        $company->setCompagnyName('Google');
        $company->setCompagnyPicture('https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png');
        $company->setLocation('London');
        $company->setWebsiteLink('https://www.google.com/');

        $companyRepository = $this->createMock(EntreprisesRepository::class);

        $companyRepository->expects($this->once())
            ->method('save')
            ->with($company);

        $companyRepository->save($company);

    }

}