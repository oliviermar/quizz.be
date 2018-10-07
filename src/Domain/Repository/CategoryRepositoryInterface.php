<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Category;

/**
 * Interface CategoryRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
interface CategoryRepositoryInterface
{
    /**
     * @param string $identifier
     *
     * @return Category
     */
    public function find(string $identifier): Category;

    /**
     * @param Category $category
     */
    public function save(Category $category);
}
