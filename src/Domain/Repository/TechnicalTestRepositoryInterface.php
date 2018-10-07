<?php

namespace App\Domain\Repository;

use App\Domain\Entity\TechnicalTest;

/**
 * interface TechnicalTestRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
interface TechnicalTestRepositoryInterface
{
    public function save(TechnicalTest $technicalTest);
}
