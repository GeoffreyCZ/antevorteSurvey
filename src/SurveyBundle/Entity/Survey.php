<?php
/**
 * @Author: Michal Kroupa <michalkrou@gmail.com>
 */

namespace SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="survey")
 */
class Survey
{

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $name;

	/**
	 * @ORM\OneToMany(targetEntity="Question", mappedBy="survey", cascade={"remove"})
	 */
	private $questions;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $password;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $status;

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
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getQuestions()
	{
		return $this->questions;
	}

	/**
	 * @param mixed $questions
	 */
	public function setQuestions($questions)
	{
		$this->questions = $questions;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

}