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

        $variants = "";

        for ($i=1; $i<=5; $i++) {

            $arr_variants = [];

            $arr_answers = [];

            $randNr = mt_rand(3,6);

            for ($j=1; $j<=$randNr; $j++) {
                $arr_variants[] = $faker->realText($faker->numberBetween(10,20));
            }

            $question = new Question();
            $question->setTitle($faker->title);
            $question->setVariants( implode("\n", $arr_variants) );

            $variants_keys = array_rand($arr_variants, mt_rand(1, $randNr));
            if (is_int($variants_keys)) {
                $arr_answers[] = [ $arr_variants[$variants_keys] ];
            } elseif (is_array($variants_keys)) {
                foreach ($variants_keys as $key) {
                    array_push($arr_answers, $arr_variants[$key]);
                }
            }
            

            for ($k=1; $k<=5; $k++) {
                $answer_{$k} = new Answer();
                $answer_{$k}->setAnswer($arr_answers);
                $answer_{$k}->setName($faker->firstName);
                $answer_{$k}->setQuestion($question);

                $em->persist($answer_{$k});
            }
            
        }

        $em->persist($question);
        $em->flush();


    }
} 