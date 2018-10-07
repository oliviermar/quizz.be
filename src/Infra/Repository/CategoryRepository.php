<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Category;
use App\Domain\Exception\CategoryNotFoundException;
use App\Domain\Repository\CategoryRepositoryInterface;

/**
 * Class CategoryRepository
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function find(string $identifier): Category
    {
        $category = $this->em->getRepository(Category::class)->find($identifier);

        if (!$category) {
            throw CategoryNotFoundException::fromIdentifier($identifier);
        }

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Category $category)
    {
        $this->em->persist($category);
        $this->em->flush();
    }
}
