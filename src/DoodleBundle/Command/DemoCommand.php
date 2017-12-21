<?php

namespace DoodleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use DoodleBundle\Entity\Question;
use DoodleBundle\Entity\Answer;
use Faker\Factory as Faker;

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

        $faker = Faker::create();

        $variants = '';

        for ($i=1; $i<=5; $i++) {
            $variants = [];

            $randNr = mt_rand(3, 6);

            for ($j=1; $j<=$randNr; $j++) {
                $variants[] = $faker->text(10);
            }

            $question = new Question();
            $question->setTitle($faker->text(25));
            $question->setVariants( implode("\n", $variants) );

            for ($k=1; $k<=5; $k++) {
                $answers = $this->getAnswers($variants, $randNr);

                $answer = new Answer();
                $answer->setAnswer($answers);
                $answer->setName($faker->firstName);
                $answer->setQuestion($question);

                $em->persist($answer);
            }

            $em->persist($question);  
        }

        $em->flush();
    }

    /**
     * @param array $variants
     * @param int $randNr
     *
     * @return array
     */
    function getAnswers(array $variants, $randNr)
    {
        $max = mt_rand(1, $randNr);
        $variant_keys = array_rand($variants, $max);
            
        $answers = [];
        if (is_array($variant_keys) === false) {
            return [
                $variants[$variant_keys]
            ];
        }

        foreach ($variant_keys as $key) {
            $answers[] = $variants[$key];
        }
        
        return $answers;
    }
} 