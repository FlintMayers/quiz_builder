<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
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
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="tags")
     * @ORM\JoinColumn("task_id", referencedColumnName="id")
     */
    private $task;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="Tag", cascade={"persist"})
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

//    public function addTask(Task $task)
//    {
//        if (!$this->tasks->contains($task)) {
//            $this->tasks->add($task);
//        }
//    }

    public function getTask()
    {
        return $this->task;
    }

    public function setTask(Task $task)
    {
        $this->task = $task;

        return $this;
    }

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
