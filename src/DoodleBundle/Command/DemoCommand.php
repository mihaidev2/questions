<?php

namespace DoodleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoCommand extends ContainerAwareCommand
{
	protected function configure()
    {
        $this->setName('setup:demo')
        	->setDescription('Add demo data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $this->getContainer()->get('demo.data')->generate($output);
    }    
} 
