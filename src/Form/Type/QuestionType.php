<?php

namespace App\Form\Type;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Question',
//                    'label' => 'Question No__question_number__',
                ]
            )
            ->add(
                'answers',
                CollectionType::class,
                [
                    'entry_type' => AnswerType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype_name' => '__answer_index__',
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
                'data_class' => Question::class,
            ]
        );
    }
}
