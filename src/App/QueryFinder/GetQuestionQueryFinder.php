<?php

namespace App\App\QueryFinder;

use App\App\Query\GetQuestionQuery;
use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepositoryInterface;

/**
 * Class GetQuestionQueryFinder
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class GetQuestionQueryFinder
{
    /** @var QuestionRepositoryInterface */
    private $questionRepository;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param GetQuestionQuery
     *
     * @return Question
     */
    public function __invoke(GetQuestionQuery $query): Question
    {
        return $this->questionRepository->find($query->getId());
    }
}
