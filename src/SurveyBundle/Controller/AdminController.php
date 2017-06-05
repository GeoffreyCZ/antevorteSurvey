<?php

namespace SurveyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{

	/**
	 * @Route("/admin", name="admin_index")
	 */
	public function indexAction()
	{
		return $this->render('admin/index.html.twig', []);
	}

	/**
	 * @Route("/admin/seznam-dotazniku", name="admin_list_surveys")
	 */
	public function listSurveysAction()
	{
		$surveys = ["1" => "jedna"];
		return $this->render('admin/listSurveys.html.twig', [$surveys]);
	}
}
