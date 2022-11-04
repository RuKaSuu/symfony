<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Form\Type\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\User;

// create a cli command for checking if a user exists in the database or not
#[AsCommand(
    name: 'app:check-user',
    description: 'Checks if a user exists in the database or not',
)]
class CheckUserCommand extends Command
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
        $question = new Question('Please enter the name of the user: ');
        $name = $helper->ask($input, $output, $question);

        // $user check if the name and surname of the user exists in the database
        $user = $em->getRepository(User::class)->findOneBy(['name' => $name]);


        if ($user) {
            $output->writeln('User exists');
            // output information about the user
            $output->writeln('Name: '.$user->getName());
            $output->writeln('Surname: '.$user->getSurname());
            $output->writeln('Age: '.$user->getAge());
            $output->writeln('Address: '.$user->getAddress());
            $output->writeln('Level: '.$user->getLevels());
            $output->writeln('Skills: '.implode(', ', $user->getSkills()));

        } else {
            $output->writeln('User does not exist');
        }

        return Command::SUCCESS;
    }

    private function getCommandHelp()
    {
        return <<<EOF
        The <info>%command.name%</info> command checks if a user exists in the database or not.
        EOF;

    }
}

