<?php

namespace DoodleBundle\Controller;

use DoodleBundle\Entity\Answer;
use DoodleBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnswerController extends Controller 
{
	public function saveAction(Request $request)
	{
		$id = $request->request->getInt('idQuestion');

		$em = $this->getDoctrine()->getManager();

		$question = $em->getRepository('DoodleBundle:Question')->find($id);

		$formData = $request->request->get('formData');

        parse_str($formData, $params);

		$answer = new Answer();
		$answer->setQuestion($question);
		$answer->setName($params['username']);
		$answer->setAnswer($params['variant']);

		$em->persist($answer);
		$em->flush();

		return new JsonResponse([
            'code' => 200,
            'username' => $answer->getName(),
            'variants' => $answer->getAnswer(),
        ]);
	}
}
