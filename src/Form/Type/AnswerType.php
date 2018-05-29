<?php

namespace App\Form\Type;

use App\Entity\Answer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'content',
                TextType::class,
                [
//                    'attr' => ['class' => 'form-control'],
                    'label' => 'Answer',
//                    'label' => 'Answer No__answer_number__',
                ]
            )
            ->add(
                'isCorrect',
                CheckboxType::class,
                [
                    'required' => false,
//                    'attr' => ['class' => 'form-check-input'],
//                    'label_attr' => ['class' => 'form-check-label'],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Answer::class,
            ]
        );
    }
}
