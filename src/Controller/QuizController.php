<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Form\Type\QuizType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends Controller
{
    /**
     * @Route("/quiz/create", name="create_quiz")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request): Response
    {
        $quiz = new Quiz();

        $form = $this->createForm(QuizType::class, $quiz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();

            return $this->redirectToRoute('quiz_index');

        }

        return $this->render(
            'quiz/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/quiz/{id}/edit", name="edit_quiz")
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $quizRepository = $em->getRepository(Quiz::class);

        $quiz = $quizRepository->find($id);

        $originalQuestions = new ArrayCollection();

        foreach ($quiz->getQuestions() as $question) {
            $originalQuestions->add($question);
        }

        $form = $this->createForm(QuizType::class, $quiz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($quiz);
            $em->flush();

            return $this->redirectToRoute('quiz_index');
        }

        return $this->render(
            'quiz/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/index", name="quiz_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(): Response
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
     * @param Request $request
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, $id): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $quizRepository = $em->getRepository(Quiz::class);
        $quiz = $quizRepository->find($id);
        $em->remove($quiz);
        $em->flush();

        return $this->redirectToRoute('quiz_index');
    }

    /**
     * @Route("/quiz/{id}/view", name="view_quiz")
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $quizRepository = $em->getRepository(Quiz::class);

        $quiz = $quizRepository->find($id);

        return $this->render(
            'quiz/view.html.twig',
            [
                'quiz' => $quiz,
            ]
        );
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
    }
}
