<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Task;
use App\Entity\Tag;
use App\Form\Type\TaskType;
use Doctrine\Common\Collections\ArrayCollection;
use http\Env\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends Controller
{
    /**
     * @Route("/tasks/create", name="create_task")
     */
    public function new(Request $request)
    {
        $task = new Task();
        $task->setDescription('quiz');

        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
//        $answer1 = new Answer();
//        $answer1->setContent('atsakymas1');
//
//        $answer11 = new Answer();
//        $answer11->setContent('atsakymas11');
//
//        $tag1 = new Tag();
//        $answer1->setTag($tag1);
//        $answer11->setTag($tag1);
//        $tag1->setName('tag1');
//        $tag1->getAnswers()->add($answer1);
//        $tag1->getAnswers()->add($answer11);
//        $tag1->setTask($task);
//        $task->getTags()->add($tag1);
//
//        $answer2 = new Answer();
//        $answer2->setContent('atsakymas2');
//        $answer3 = new Answer();
//        $answer3->setContent('atsakymas3');
//        $tag2 = new Tag();
//        $answer2->setTag($tag2);
//        $answer3->setTag($tag2);
//        $tag2->setName('tag2');
//        $tag2->setTask($task);
//        $tag2->getAnswers()->add($answer2);
//        $tag2->getAnswers()->add($answer3);
//        $task->getTags()->add($tag2);
//
//        $tag3 = new Tag();
//        $tag3->setName('tag3');
//        $tag3->setTask($task);
//        $task->getTags()->add($tag3);
        // end dummy code

        $em = $this->getDoctrine()->getManager();
//        dump($form->getData());die;
        $em->persist($task);
        $em->flush();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... maybe do some form processing, like saving the Task and Tag objects
            $em = $this->getDoctrine()->getManager();
            dump($form->getData());die;
            $em->persist($task);
            $em->flush();

        }

        return $this->render('task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/tasks", name="list_tasks")
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository(Task::class)->findAll();

        return $this->render(
            'task/list.html.twig',
            [
                'tasks' => $tasks,
            ]
        );
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
