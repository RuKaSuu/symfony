<?php

use App\Entity\Jobs;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Question\Question;

// create a cli command for checking all jobs who dosen't match with the user's skills
#[AsCommand(
    name: 'app:matching',
    description: 'Checks all jobs who dosen\'t match with the user\'s skills',
)]

class MatchingCommand extends Command
{
    private $entityManager;
    private $io;

        public function __construct(EntityManagerInterface $entityManager)
        {
            parent::__construct();
            $this->entityManager = $entityManager;
        }

        protected function configure(): void
        {
            $this
                ->setHelp($this->getCommandHelp());
            // commands can optionally define arguments and/or options (mandatory and optional)
            // see https://symfony.com/doc/current/components/console/console_arguments.html

        }

        protected function execute(InputInterface $input, OutputInterface $output): int
        {
            $em = $this->entityManager;

            $helper = $this->getHelper('question');
            $question = new Question('Please enter the name of the company: ');
            $name = $helper->ask($input, $output, $question);

            // check all jobs who dosen't match with all user's skills
            $jobs = $em->getRepository(Jobs::class)->findBy(['company' => $name]);
            $users = $em->getRepository(User::class)->findAll();

            foreach ($jobs as $job) {
                foreach ($users as $user) {
                    if ($job->getSkills() != $user->getSkills()) {
                        $output->writeln('Job: '.$job->getTitle());
                        $output->writeln('Company: '.$job->getCompany());
                        $output->writeln('Skills: '.$job->getSkills());
                        $output->writeln('Location: '.$job->getLocation());
                        $output->writeln('Description: '.$job->getDescription());
                        $output->writeln('Salary: '.$job->getSalary());
                        $output->writeln(' ');
                    }
                }
            }

            return Command::SUCCESS;
        }


}