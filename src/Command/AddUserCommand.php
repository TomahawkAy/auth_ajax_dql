<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AddUserCommand extends Command
{

    protected static $defaultName = 'app:user:create';
    protected $encoder;
    protected $manager;
    public function  __construct($name = null,UserPasswordEncoderInterface $e,EntityManagerInterface $manager)
    {
        parent::__construct($name);
        $this->encoder = $e;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $user = new User();
        $password = 'password';
        $user->setUsername('faltenux');
        $user->setRoles(array('ROLE_USER'));
        $user->setPassword($this->encoder->encodePassword($user,$password));
        $this->manager->persist($user);
        $this->manager->flush();
        return 0;
    }
}
