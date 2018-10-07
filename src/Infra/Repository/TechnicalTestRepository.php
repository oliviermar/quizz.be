<?php

namespace App\Infra\Repository;

use App\Domain\Repository\TechnicalTestRepositoryInterface;
use App\Domain\Entity\TechnicalTest;

/**
 * class TechnicalTestRepository
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class TechnicalTestRepository extends AbstractRepository implements TechnicalTestRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function save(TechnicalTest $technicalTest)
    {
        $this->em->persist($technicalTest);
        $this->em->flush();
    }
}
