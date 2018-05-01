<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="questions")
     * @ORM\JoinColumn("quiz_id", referencedColumnName="id")
     */
    private $quiz;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="Question", cascade={"persist"})
     */
    protected $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param mixed $quiz
     *
     * @return Question
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

//    public function addTask(Task $task)
//    {
//        if (!$this->tasks->contains($task)) {
//            $this->tasks->add($task);
//        }
//    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer)
    {
        $answer->setTag($this);

        $this->answers->add($answer);
    }

    public function removeAnswer(Answer $answer)
    {
        $this->answers->removeElement($answer);
    }
}
