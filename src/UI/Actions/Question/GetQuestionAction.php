<?php

namespace App\UI\Actions\Question;

use App\App\Query\GetQuestionQuery;
use App\Domain\Serializer\QuestionSerializerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetQuestionAction
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class GetQuestionAction
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
     * @param string $id
     *
     * @return JsonResponse
     */
    public function __invoke(string $id)
    {
        $question = $this->bus->dispatch(GetQuestionQuery::fromIdentifier($id));

        return new JsonResponse(
            $this->questionSerializer->serialize($question),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
