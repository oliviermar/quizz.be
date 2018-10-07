<?php

namespace App\App\QueryFinder;

use App\App\Query\GetQuestionListQuery;
use App\Domain\Entity\Category;
use App\Domain\Repository\QuestionRepositoryInterface;
use App\Domain\Repository\CategoryRepositoryInterface;

/**
 * class GetQuestionListQueryFinder
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class GetQuestionListQueryFinder
{
    /** @var QuestionRepositoryInterface */
    private $questionRepository;

    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param GetQuestionListQuery
     *
     * @return Question
     */
    public function __invoke(GetQuestionListQuery $query): array
    {
        $category = $this->categoryRepository->find($query->getCategoryId());

        $categoriesIds = $this->getRecursiveCategoryId($category);

        return $this->questionRepository->getByCategoriesIds($categoriesIds);
    }

    /**
     * @param Category $category
     * @param array    $categoriesId
     */
    public function getRecursiveCategoryId(Category $category, array $categoriesId = [])
    {
        $categoriesId[] = $category->getId();
        foreach ($category->getChilds() as $child) {
            $this->getRecursiveCategoryId($child, $categoriesId);
        }

        return $categoriesId;
    }
}
