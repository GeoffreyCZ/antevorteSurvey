<?php
/**
 * @author Michal Kroupa <michalkrou@gmail.com>
 */

namespace SurveyBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AnswerType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('answer', TextType::class, array(
				'label' => false,
				'attr' => array(
					'class' => 'form-control input-sm'
				)
			));
	}
}