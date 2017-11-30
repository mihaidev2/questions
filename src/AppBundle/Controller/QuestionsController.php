<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class QuestionsController extends Controller {

	/**
	 * @Route("/", name="questions_list")
	 */
	public function listAction(Request $request)
	{



		return $this->render('questions/index.html.twig');
	}

	/**
	  * @Route("/edit/{id}", name="questions_edit")
	  */
	public function editAction($id, Request $request) {
		return $this->render('questions/edit.html.twig');
	}

	/**
	  * @Route("/details/{id}", name="questions_details")
	  */
	public function detailsAction($id) {
		return $this->render('questions/details.html.twig');
	}

}