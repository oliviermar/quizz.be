<?php

namespace App\UI\Actions\TechnicalTest;

use App\App\Command\CreateTechnicalTestCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Ramsey\Uuid\Uuid;

/**
 * class CreateTechnicalTestAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class CreateTechnicalTestAction
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

    public function __invoke(Request $request)
    {
        $id = Uuid::uuid4();
        $requestData = json_decode($request->getContent(), true);
        $command = CreateTechnicalTestCommand::fromData($id, $requestData['questions_id'], $requestData['recruiter_id']); // TODO Use token storage for get recruiter_id

        $errors = $this->validator->validate($command);
        if ($errors->count() > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        $this->bus->dispatch($command);

        return new JsonResponse(json_encode(['id' => $id]), Response::HTTP_CREATED);
    }
}
