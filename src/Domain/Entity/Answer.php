<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Answer
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Answer
{
    /** @var string */
    private $id;

    /** @var string */
    private $label;

    /** @param Question */
    private $question;

    /**
     * @param UuidInterface $uuid
     * @param string        $label
     */
    public function __construct(UuidInterface $uuid, string $label, Question $question)
    {
        $this->id = $uuid;
        $this->label = $label;
        $this->question = $question;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }
}
