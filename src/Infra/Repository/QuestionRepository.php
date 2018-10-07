<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepositoryInterface;
use App\Infra\Repository\AbstractRepository;

/**
 * Class QuestionRepository
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class QuestionRepository extends AbstractRepository implements QuestionRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function find(string $identifier): Question
    {
        $question = $this->em->getRepository(Question::class)->find($identifier);

        if (!$question) {
            throw QuestionNotFoundException::fromIdentifier($identifier);
        }

        return $question;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Question $question)
    {
        $this->em->persist($question);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCategoriesIds(array $categoriesIds)
    {
        $qb = $this->em->getRepository(Question::class)->createQueryBuilder('q');
        $qb
            ->join('q.category', 'c')
            ->where($qb->expr()->in('c.id', ':categoriesId'))
            ->setParameter('categoriesId', $categoriesIds)
        ;

        return $qb->getQuery()->getResult();
    }
}
