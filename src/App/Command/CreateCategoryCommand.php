<?php

namespace App\App\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * Class CreateCategoryCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class CreateCategoryCommand
{
    /** @var string */
    private $id;

    /** @var string */
    private $label;

    /** @var string */
    private $parentId;

    /**
     * @param array $data
     */
    public function __construct(string $id, string $label, string $parentId = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->parentId = $parentId;
    }

    /**
     * @param array $data
     *
     * @return CreateCategoryCommand
     */
    public static function fromData(array $data): CreateCategoryCommand
    {
        return new self(
            $data['id'],
            $data['label'],
            $data['parent_id']
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }
}
