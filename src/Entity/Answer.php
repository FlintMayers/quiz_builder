<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer
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
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="answers")
     * @ORM\JoinColumn("tag_id", referencedColumnName="id")
     */
    private $tag;

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

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     *
     * @return Answer
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

//    public function addTask(Task $task)
//    {
//        if (!$this->tasks->contains($task)) {
//            $this->tasks->add($task);
//        }
//    }

//    public function getTask()
//    {
//        return $this->task;
//    }
//
//    public function setTask(Task $task)
//    {
//        $this->task = $task;
//
//        return $this;
//    }
}
