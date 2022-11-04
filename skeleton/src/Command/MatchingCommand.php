<?php

namespace App\Command;

use App\Entity\Jobs;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'app:matching',
    description: 'Checks if a user exists in the database or not',
)]
class MatchingCommand extends Command
{
    private EntityManagerInterface $entityManager;

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

    private function getCommandHelp(): string
    {
        return <<<EOF
        The <info>%command.name%</info> command checks if a user exists in the database or not.
        EOF;

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->entityManager;

        $helper = $this->getHelper('question');
        $question = new Question('Please enter the id of the user: ');
        $name = $helper->ask($input, $output, $question);
        $output->writeln('---------------------------------------------');

        // check all jobs who don't match with all user's skills
        $jobs = $em->getRepository(Jobs::class)->findBy(['company' => $name]);
        $users = $em->getRepository(User::class)->findAll();


        foreach ($users as $user) {
            foreach ($jobs as $job) {
                if (!array_intersect($job->getSkills(), $user->getSkills())) {
                    $date = $job->getPostDate();
                    $output->writeln('Title: ' . $job->getTitle());
                    $output->writeln('PostDate: ' . $date->format('d-m-Y'));
                    $output->writeln('Degree: ' . $job->getDegree());
                    $output->writeln('Description: ' . $job->getDescription());
                    $output->writeln('Location: ' . $job->getLocation());
                    $output->writeln('Skills: ' . implode(', ', $job->getSkills()));
                    $output->writeln('Company: ' . $job->getCompany());
                    $output->writeln('------------------------------------------------------------------');
                }else{
                    $output->writeln('No jobs found');
                }

            }
        }

        return Command::SUCCESS;
    }
}
