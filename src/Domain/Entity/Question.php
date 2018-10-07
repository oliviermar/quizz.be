<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Question
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class Question
{
    /** @var string */
    private $id;

    /** @var string */
    private $label;

    /** @var boolean */
    private $qcm;

    /** @var Category */
    private $category;

    /** @var string */
    private $level;

    /** @var array */
    private $answers;

    /**
     * @param UuidInterface $uuid
     * @param string        $label
     * @param boolean       $qcm
     * @param string        $level
     */
    public function __construct(UuidInterface $uuid, string $label, bool $qcm = false, Category $category, string $level = null)
    {
        $this->id = (string) $uuid;
        $this->label = $label;
        $this->qcm = $qcm;
        $this->category = $category;
        $this->level = $level;
        $this->answers = [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function isQcm(): bool
    {
        return $this->qcm;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function addAnswer(Answer $answer): Question
    {
        $this->answers[] = $answer;

        return $this;
    }

    public function getAnswers(): \Traversable
    {
        return $this->answers;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }
}
