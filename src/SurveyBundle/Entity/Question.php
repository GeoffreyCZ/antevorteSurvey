<?php

/**
 * @Author: Michal Kroupa <michalkrou@gmail.com>
 */

namespace SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $question;

	/**
	 * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
	 */
	private $answers;

	/**
	 * @ORM\ManyToOne(targetEntity="Survey", inversedBy="questions")
	 * @ORM\JoinColumn(name="survey", referencedColumnName="id")
	 */
	private $survey;

	/**
	 * @ORM\ManyToOne(targetEntity="QuestionTypeEnum")
	 * @ORM\JoinColumn(name="question_type_enum", referencedColumnName="id")
	 */
	private $questionType;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getQuestion()
	{
		return $this->question;
	}

	/**
	 * @param mixed $question
	 */
	public function setQuestion($question)
	{
		$this->question = $question;
	}

	/**
	 * @return mixed
	 */
	public function getAnswers()
	{
		return $this->answers;
	}

	/**
	 * @param mixed $answers
	 */
	public function setAnswer($answers)
	{
		$this->answers = $answers;
	}

	/**
	 * @return mixed
	 */
	public function getQuestionType()
	{
		return $this->questionType;
	}

	/**
	 * @param mixed $questionType
	 */
	public function setQuestionType($questionType)
	{
		$this->questionType = $questionType;
	}

	/**
	 * @return mixed
	 */
	public function getSurvey()
	{
		return $this->survey;
	}

	/**
	 * @param mixed $survey
	 */
	public function setSurvey($survey)
	{
		$this->survey = $survey;
	}

}