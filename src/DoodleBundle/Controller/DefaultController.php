<?php

namespace DoodleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller 
{
	public function indexAction() 
	{
		return $this->render('DoodleBundle:Default:index.html.twig');
	}
}
