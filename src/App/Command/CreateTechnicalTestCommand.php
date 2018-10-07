<?php

namespace App\App\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * class CreateTechnicalTestCommand
 *
 * @author Olivier Maréchal
 */
class CreateTechnicalTestCommand
{
    /** @var UuidInterface */
    private $id;

    /** @var array */
    private $questionsId;

    /** @var string */
    private $recruiterId;

    public function __construct(UuidInterface $id, array $questionsId, string $recruiterId)
    {
        $this->id = $id;
        $this->questionsId = $questionsId;
        $this->recruiterId = $recruiterId;
    }

    public static function fromData(UuidInterface $id, array $questionsId, string $recruiterId): CreateTechnicalTestCommand
    {
        return new self($id, $questionsId, $recruiterId);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getQuestionsId(): array
    {
        return $this->questionsId;
    }

    public function getRecruiterId(): string
    {
        return $this->recruiterId;
    }
}
