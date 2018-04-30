<?php

namespace App\Entity;

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
}
