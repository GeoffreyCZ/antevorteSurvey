<?php

namespace SurveyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SurveyBundle\Entity\Survey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
		$surveys = $this->getDoctrine()->getRepository(Survey::class)->findAll();
		return $this->render('admin/listSurveys.html.twig', [
			'surveys' => $surveys
		]);
	}

	/**
	 * @param Request $request
	 * @Route("/admin/dotaznik/smazat", name="admin_delete_survey")
	 * @return JsonResponse | Response
	 */
	public function ajaxDeleteSurveyAction(Request $request)
	{
		$response = [
			"code" => 200,
			"success" => true
		];
		return new JsonResponse($response);
	}
}
