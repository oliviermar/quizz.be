<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Recruiter;

/**
 * Interface RecruiterRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
interface RecruiterRepositoryInterface
{
    /**
     * @param string $identifier
     *
     * @return Recruiter
     */
    public function find(string $identifier);

    /**
     * @param array $criteria
     */
    public function findOneBy(array $criteria);

    /**
     * @param Recruiter $recruiter
     */
    public function save(Recruiter $recruiter);
}
