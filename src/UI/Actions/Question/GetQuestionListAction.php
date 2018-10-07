<?php

namespace App\UI\Actions\Question;

use App\App\Query\GetQuestionListQuery;
use App\Domain\Serializer\QuestionSerializerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetQuestionListAction
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class GetQuestionListAction
{
    /** @var QuestionSerializerInterface */
    private $questionSerializer;

    /** @var MessageBusInterface */
    private $bus;

    /**
     * @param QuestionSerializerInterface $questionSerializer
     */
    public function __construct(QuestionSerializerInterface $questionSerializer, MessageBusInterface $bus)
    {
        $this->questionSerializer = $questionSerializer;
        $this->bus = $bus;
    }

    /**
     * @param string $categoryId
     *
     * @return JsonResponse
     */
    public function __invoke(string $categoryId)
    {
        $questions = $this->bus->dispatch(GetQuestionListQuery::formCategoryId($categoryId));

        return new JsonResponse(
            $this->questionSerializer->serialize($questions),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
