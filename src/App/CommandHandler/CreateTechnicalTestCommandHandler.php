<?php

namespace App\App\CommandHandler;

use App\App\Command\CreateTechnicalTestCommand;
use App\Domain\Entity\TechnicalTest;
use App\Domain\Entity\Question;
use App\Domain\Repository\TechnicalTestRepositoryInterface;
use App\Domain\Repository\QuestionRepositoryInterface;
use App\Domain\Repository\RecruiterRepositoryInterface;

/**
 * class CreateTechnicalTestCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class CreateTechnicalTestCommandHandler
{
    /** @var TechnicalTestRepositoryInterface */
    private $technicalTestRepository;

    /** @var QuestionRepositoryInterface */
    private $questionRepository;

    /** @var RecruiterRepositoryInterface */
    private $recruiterRepository;

    /**
     * @param TechnicalTestRepositoryInterface $technicalTestRepository
     * @param QuestionRepositoryInterface      $questionRepository
     */
    public function __construct(TechnicalTestRepositoryInterface $technicalTestRepository, QuestionRepositoryInterface $questionRepository, RecruiterRepositoryInterface $recruiterRepository)
    {
        $this->technicalTestRepository = $technicalTestRepository;
        $this->questionRepository = $questionRepository;
        $this->recruiterRepository = $recruiterRepository;
    }

    /**
     * @param CreateTechnicalTestCommand $command
     */
    public function __invoke(CreateTechnicalTestCommand $command)
    {
        $recruiter = $this->recruiterRepository->find($command->getRecruiterId());

        $technicalTest = new TechnicalTest($command->getId(), $recruiter);
        foreach ($command->getQuestionsId() as $questionId) {
            $question = $this->questionRepository->find($questionId);
            if ($question instanceof Question) {
                $technicalTest->addQuestion($question);
            }
        }

        $this->technicalTestRepository->save($technicalTest);
    }
}
