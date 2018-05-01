<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Form\Type\QuizType;
use Doctrine\Common\Collections\ArrayCollection;
use http\Env\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends Controller
{
    /**
     * @Route("/quiz/create", name="create_quiz")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $quiz = new Quiz();

//        $this->setDummyData($quiz);

        $form = $this->createForm(QuizType::class, $quiz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();

        }

        return $this->render(
            'quiz/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/quizzes", name="list_quizzes")
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();

        $quizzes = $em->getRepository(Quiz::class)->findAll();

        return $this->render(
            'quiz/list.html.twig',
            [
                'quizzes' => $quizzes,
            ]
        );
    }

    /**
     * @Route("/quiz/{id}/delete", name="delete_quiz")
     */
    public function delete(Request $request, $id)
    {
//        dump($quiz);die;
//        $em = $this->getDoctrine()->getManager();
//        $quiz = $em->getRepository(Quiz::class)->find($quiz);
//        $em->remove($quiz);
//
//        $em->flush();
    }

    /**
     * @param Quiz $quiz
     */
    private function setDummyData($quiz): void
    {
        $quiz->setTitle('quiz');

        $answer1 = new Answer();
        $answer1->setContent('atsakymas1');

        $answer11 = new Answer();
        $answer11->setContent('atsakymas11');

        $question1 = new Question();
        $answer1->setQuestion($question1);
        $answer11->setQuestion($question1);
        $question1->setName('question1');
        $question1->getAnswers()->add($answer1);
        $question1->getAnswers()->add($answer11);
        $question1->setQuiz($quiz);
        $quiz->getQuestions()->add($question1);

        $answer2 = new Answer();
        $answer2->setContent('atsakymas2');
        $answer22 = new Answer();
        $answer22->setContent('atsakymas22');
        $question2 = new Question();
        $answer2->setQuestion($question2);
        $answer22->setQuestion($question2);
        $question2->setName('question2');
        $question2->setQuiz($quiz);
        $question2->getAnswers()->add($answer2);
        $question2->getAnswers()->add($answer22);
        $quiz->getQuestions()->add($question2);

        $question3 = new Question();
        $question3->setName('question3');
        $question3->setQuiz($quiz);
        $quiz->getQuestions()->add($question3);

        $em = $this->getDoctrine()->getManager();
        $em->persist($quiz);
        $em->flush();
    }

//    /**
//     * @Route("/tasks/edit/{id}", name="edit_task")
//     */
//    public function edit($id, Request $request)
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $task = $entityManager->getRepository(Task::class)->find($id);
//
//        if (!$task) {
//            throw $this->createNotFoundException('No task found for id '.$id);
//        }
//
//        $originalTags = new ArrayCollection();
//
//        // Create an ArrayCollection of the current Tag objects in the database
//        foreach ($task->getTags() as $tag) {
//            $originalTags->add($tag);
//        }
//
//        $editForm = $this->createForm(TaskType::class, $task);
//
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//
//            // remove the relationship between the tag and the Task
//            foreach ($originalTags as $tag) {
//                if (false === $task->getTags()->contains($tag)) {
//                    // remove the Task from the Tag
//                    $tag->getTasks()->removeElement($task);
//
//                    // if it was a many-to-one relationship, remove the relationship like this
//                    // $tag->setTask(null);
//
//                    $entityManager->persist($tag);
//
//                    // if you wanted to delete the Tag entirely, you can also do that
//                    // $entityManager->remove($tag);
//                }
//            }
//
//            $entityManager->persist($task);
//            $entityManager->flush();
//
//            // redirect back to some edit page
//            return $this->redirectToRoute('task_edit', array('id' => $id));
//        }
//
//        // render some form template
//    }

}
