<?php

namespace SurveyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SurveyBundle\Entity\Survey;
use SurveyBundle\FormType\SurveyType;
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
	public function listSurveysAction(Request $request)
	{
		$surveys = $this->getDoctrine()->getRepository(Survey::class)->findAll();
		$form = $this->createForm(SurveyType::class);

		return $this->render('admin/listSurveys.html.twig', [
			'surveys' => $surveys,
			'form' => $form->createView()
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse | Response
	 * @Route("/admin/dotaznik/smazat", name="admin_delete_survey")
	 */
	public function deleteSurveyAction(Request $request)
	{
		$surveyId = $request->get('surveyId');
		$survey = $this->getDoctrine()->getRepository(Survey::class)->findOneBy(['id' => $surveyId]);

		$em = $this->getDoctrine()->getManager();
		$em->remove($survey);
		$em->flush();

		$response = [
			"code" => 200,
			"success" => true
		];
		return new JsonResponse($response);
	}

	/**
	 * @param Request $request
	 * @return Response
	 * @Route("/admin/dotaznik/vytvorit", name="admin_ajax_create_survey")
	 */
	public function createSurveyAjaxAction(Request $request)
	{
		$survey = new Survey();
		$surveyName = $request->get('surveyName');
		$surveyPassword = $request->get('surveyPassword');
		$survey->setName($surveyName);
		$survey->setPassword($surveyPassword);
		$survey->setStatus('active');

		$em = $this->getDoctrine()->getManager();
		$em->persist($survey);
		$em->flush();

		$response = [
			"code" => 200,
			"success" => true,
			"surveyId" => $survey->getId()
		];

		return new JsonResponse($response);
	}

	/**
	 * @param integer $surveyId
	 * @param Request $request
	 * @return Response
	 * @Route("/admin/dotaznik/upravit/{surveyId}", defaults={"surveyId" = 0}, name="admin_update_survey")
	 */
	public function updateSurveyAction(Request $request, $surveyId)
	{
		$survey = $this->getDoctrine()->getRepository(Survey::class)->findOneBy(['id' => $surveyId]);
		$form = $this->createForm(SurveyType::class, $survey);

		$form->handleRequest($request);

		return $this->render('admin/updateSurvey.html.twig', [
			'form' => $form->createView()
		]);
	}
}
