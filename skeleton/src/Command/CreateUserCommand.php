<?php
/*
namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Form\Type\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\User;

// create a cli command for adding a user to the database
#[AsCommand(
    name: 'app:create-user',
    description: 'Adds a user to the database',
)]

class CreateUserCommand extends Command
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
            ->setHelp($this->getCommandHelp())
            // commands can optionally define arguments and/or options (mandatory and optional)
            // see https://symfony.com/doc/current/components/console/console_arguments.html
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the user')
            ->addArgument('surname', InputArgument::REQUIRED, 'The surname of the user')
            ->addArgument('age', InputArgument::REQUIRED, 'The age of the user')
            ->addArgument('address', InputArgument::REQUIRED, 'The address of the user')
            ->addArgument('level', InputArgument::REQUIRED, 'The level of the user')
            ->addArgument('skills', InputArgument::IS_ARRAY, 'The skills of the user');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->entityManager;

        $user = new User();
        $user->setName($input->getArgument('name'));
        $user->setSurname($input->getArgument('surname'));
        $user->setAge($input->getArgument('age'));
        $user->setAddress($input->getArgument('address'));
        $user->setLevel($input->getArgument('level'));
        $user->setSkills($input->getArgument('skills'));

        $em->persist($user);
        $em->flush();

        $output->writeln('User created');

        return Command::SUCCESS;
    }

    protected function getCommandHelp(): string
    {
        return <<<'EOF'
    The <info>%command.name%</info> command creates a user:
    EOF;
    }
}

*/
