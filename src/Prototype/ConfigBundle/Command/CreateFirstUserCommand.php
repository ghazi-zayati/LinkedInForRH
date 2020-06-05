<?php
namespace Prototype\ConfigBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFirstUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('create:firstUser')
            ->setDescription('create first user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $this->getContainer()->get('app_user_service')->createFirstUser();
        $output->writeln($text);
    }
}
