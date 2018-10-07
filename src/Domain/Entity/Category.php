<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Category
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class Category
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $label;

    /**
     * @var Category
     */
    private $parent;

    /**
     * @var Category[]
     */
    private $childs;

    /**
     * @var Question[]
     */
    private $questions;

    /**
     * @param UuidInterface $id
     * @param string        $label
     * @param Category      $parent
     */
    public function __construct(UuidInterface $id, string $label, Category $parent = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->parent = $parent;
        $this->childs = [];
        $this->questions = [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getChilds(): \Traversable
    {
        return $this->childs;
    }

    public function addChild(Category $category): Category
    {
        $this->childs[] = $category;

        return $this;
    }

    public function getQuestions()
    {
        return $this->questions;
    }
}
