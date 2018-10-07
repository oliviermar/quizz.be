<?php

namespace App\App\Query;

/**
 * Class GetQuestionListQuery
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class GetQuestionListQuery
{
    /** @var string */
    private $categoryId;

    public static function formCategoryId(string $categoryId): GetQuestionListQuery
    {
        return new self($categoryId);
    }

    public function __construct(string $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}
