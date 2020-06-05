<?php
namespace Prototype\ConfigBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreatePermissionsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('create:permissions')
            ->setDescription('create permissions')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text =  $this->getContainer()->get('app_permission_service')->createPermissions();
        $output->writeln($text);
    }
}
