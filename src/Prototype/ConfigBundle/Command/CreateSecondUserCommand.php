<?php
/**
 * Created by PhpStorm.
 * User: Bassem
 * Date: 28/09/2018
 * Time: 11:21
 */

namespace Prototype\ConfigBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSecondUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('create:secondUser')
            ->setDescription('create second user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = "user created successfully";
        $this->getContainer()->get('app_user_service')->createSecondtUser();
        $output->writeln($text);
    }
}
