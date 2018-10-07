<?php

namespace App\UI\Actions\Question;

use App\App\Command\CreateQuestionCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CreateQuestionAction
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class CreateQuestionAction
{
    /** @var MessageBusInterface */
    private $bus;

    /** @var ValidatorInterface */
    private $validator;

    /**
     * @param MessageBusInterface $bus
     * @param ValidatorInterface  $validator
     */
    public function __construct(MessageBusInterface $bus, ValidatorInterface $validator)
    {
        $this->bus = $bus;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $id = Uuid::uuid4();
        $commandData = array_merge(
            ['id' => $id],
            json_decode($request->getContent(), true)
        );

        $command = CreateQuestionCommand::fromData($commandData);
        $errors = $this->validator->validate($command);

        if ($errors->count() > 0) {
            return new JsonResponse(
                (string) $errors,
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $this->bus->dispatch($command);

        return new JsonResponse(json_encode(['id' => $id]), Response::HTTP_CREATED, [], true);

    }
}
