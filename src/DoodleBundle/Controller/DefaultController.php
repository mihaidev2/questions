<?php

namespace DoodleBundle\Controller;

use DoodleBundle\Entity\Answer;
use DoodleBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller 
{
	public function indexAction() 
	{
	    $em = $this->getDoctrine()->getManager();

	    /*
	    $question = new Question();
	    $question->setTitle('Intalnire Liceu');
	    $question->setVariants("12 Dec\n13 Dec\n14 Dec");

	    $answer_1 = new Answer();
	    $answer_1->setAnswer('12 Dec');
	    $answer_1->setQuestion($question);
	    $question->addAnswers($answer_1);

	    $answer_2 = new Answer();
	    $answer_2->setAnswer('14 Dec');
	    $answer_2->setQuestion($question);
	    $question->addAnswers($answer_2);

	    $em->persist($question);
	    $em->flush();
	    */

//	    $question = $em->getRepository('DoodleBundle:Question')->find(6);

//	    dump($question->getAnswers()[0]);die;

//        $answer = $em->getRepository('DoodleBundle:Answer')->find(1);
//
//        dump($answer->getQuestion()->getTitle());die;

        return $this->render('DoodleBundle:Default:index.html.twig');
	}
}
