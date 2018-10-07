<?php

namespace App\App\CommandHandler;

use App\App\Command\CreateQuestionCommand;
use App\Domain\Entity\Answer;
use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepositoryInterface;
use App\Domain\Repository\CategoryRepositoryInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class CreateQuestionCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class CreateQuestionCommandHandler
{
    /** @var QuestionRepositoryInterface */
    private $questionRepository;

    /** @var CategoryRepository */
    private $categoryRepository;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CreateQuestionCommand $command
     */
    public function __invoke(CreateQuestionCommand $command)
    {
        $category = $this->categoryRepository->find($command->getCategoryId());

        $question = new Question(
            $command->getId(),
            $command->getLabel(),
            $command->isQcm(),
            $category,
            $command->getLevel()
        );

        foreach ($command->getAnswers() as $answerData) {
            $answer = new Answer(Uuid::uuid4(), $answerData['label'], $question);
            $question->addAnswer($answer);
        }

        $this->questionRepository->save($question);
    }
}
