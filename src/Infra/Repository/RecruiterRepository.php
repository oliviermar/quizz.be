<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Recruiter;
use App\Domain\Repository\RecruiterRepositoryInterface;

/**
 * Class RecruiterRepository
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class RecruiterRepository extends AbstractRepository implements RecruiterRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function find(string $identifier)
    {
        return $this->em->getRepository(Recruiter::class)->find($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository(Recruiter::class)->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function save(Recruiter $recruiter)
    {
        $this->em->persist($recruiter);
        $this->em->flush();
    }
}
