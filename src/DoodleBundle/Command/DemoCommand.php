<?php

namespace DoodleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use DoodleBundle\Entity\Question;
use DoodleBundle\Entity\Answer;

class DemoCommand extends ContainerAwareCommand
{
	protected function configure()
    {
        $this->setName('setup:demo')
        	->setDescription('Add demo data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeLn('Hello');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $question = new Question();
        $question->setTitle("Where do we go next weekend?");
        $question->setVariants("Sinaia\nBusteni\nAzuga\nPredeal\nPoiana Rasnov");

        $answer_1 = new Answer();
        $answer_1->setAnswer(['Sinaia']);
        $answer_1->setName('Bogdan');
        $answer_1->setQuestion($question);

        $em->persist($answer_1);
        $em->persist($question);
        $em->flush();


    }
} 