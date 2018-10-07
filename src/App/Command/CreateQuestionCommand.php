<?php

namespace App\App\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * Class CreateQuestionCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class CreateQuestionCommand
{
    /** @var string */
    private $id;

    /** @var string */
    private $label;

    /** @var bool */
    private $qcm;

    /** @var string */
    private $categoryId;

    /** @var string */
    private $level;

    /** @var array */
    private $answers;

    /**
     * @param array $data
     */
    public function __construct(string $id, string $label, string $categoryId, string $level = null, bool $qcm = false, $answers = [])
    {
        $this->id = $id;
        $this->label = $label;
        $this->categoryId = $categoryId;
        $this->level = $level;
        $this->qcm = $qcm;
        $this->answers = $answers;
    }

    /**
     * @param array $data
     *
     * @return CreateQuestionCommand
     */
    public static function fromData(array $data): CreateQuestionCommand
    {
        return new self($data);
    }

    public function getId(): UuidInterface
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

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}
