<?php

namespace App\Infra\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Abstract class AbstractRepository
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
abstract class AbstractRepository
{
    /** @var EntityManagerInterface */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
