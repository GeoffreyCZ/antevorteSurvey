<?php
/**
 * @author Michal Kroupa <michalkrou@gmail.com>
 */

namespace SurveyBundle\FormType;

use SurveyBundle\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('question', TextType::class, array(
				'label' => false,
				'attr' => array(
					'class' => 'form-control input-sm'
				)
			))
			->add('answers', CollectionType::class, [
				'label' => false,
				'entry_type' => AnswerType::class,
				'allow_add' => true,
				'by_reference' => false,
				'allow_delete' => true
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => Question::class,
		));
	}
}