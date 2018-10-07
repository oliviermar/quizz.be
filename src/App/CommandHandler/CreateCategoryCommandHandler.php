<?php

namespace App\App\CommandHandler;

use App\App\Command\CreateCategoryCommand;
use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class CreateCategoryCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class CreateCategoryCommandHandler
{
    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CreateCategoryCommand $command
     */
    public function __invoke(CreateCategoryCommand $command)
    {
        $parent = null;
        if ($command->getParentId()) {
            $parent = $this->categoryRepository->find($command->getParentId());
        }

        $category = new Category(
            $command->getId(),
            $command->getLabel(),
            $parent
        );

        if (null !== $parent) {
            $parent->addChild($category);
        }

        $this->categoryRepository->save($category);
    }
}
