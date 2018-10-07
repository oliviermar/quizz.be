<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * class TechnicalTest
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class TechnicalTest
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Recruiter
     */
    private $recruiter;

    /**
     * @var Question[]
     */
    private $questions;

    /**
     * @param UuidInterface $id
     * @param Recruiter     $recruiter
     */
    public function __construct(UuidInterface $id, Recruiter $recruiter)
    {
        $this->id = $id;
        $this->recruiter = $recruiter;
        $this->questions = [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Recruiter
     */
    public function getRecruiter(): Recruiter
    {
        return $this->recruiter;
    }

    /**
     * @return Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     *
     * @return TechnicalTest
     */
    public function addQuestion(Question $question): TechnicalTest
    {
        if (!isset($this->questions[$question->getId()])) {
            $this->questions[$question->getId()] = $question;
        }

        return $this;
    }

    /**
     * @param array $questions
     *
     * @return TechnicalTest
     */
    public function addQuestions(array $questions = []): TechnicalTest
    {
        foreach ($questions as $question) {
            $this->addQuestion($question);
        }
    }
}
