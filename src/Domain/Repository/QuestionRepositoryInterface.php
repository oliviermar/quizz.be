<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Question;

/**
 * Interface QuestionRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
interface QuestionRepositoryInterface
{
    /**
     * @param string $identifier
     *
     * @return Question
     */
    public function find(string $identifier): Question;

    /**
     * @param Question $question
     */
    public function save(Question $question);

    /**
     * @param array $categoriesIds
     *
     * @return Question[]
     */
    public function getByCategoriesIds(array $categoriesIds);
}
