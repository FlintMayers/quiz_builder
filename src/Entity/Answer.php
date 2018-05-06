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
     * @var int $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $content
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @var bool $isCorrect
     * @ORM\Column(type="boolean")
     */
    private $isCorrect;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     * @ORM\JoinColumn("question_id", referencedColumnName="id")
     */
    private $question;

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
     * @return bool
     */
    public function isCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * @param $isCorrect
     * @return $this
     */
    public function setIsCorrect($isCorrect): self
    {
        $this->isCorrect = $isCorrect;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     *
     * @return $this
     */
    public function setQuestion($question): self
    {
        $this->question = $question;

        return $this;
    }
}
