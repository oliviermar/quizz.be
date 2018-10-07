<?php

namespace App\UI\Actions\Recruiter;

use App\App\Command\RegisterRecruiterCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * class RegisterRecruiterAction
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class RegisterRecruiterAction
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

        $data = array_merge(
            json_decode($request->getContent(), true),
            ['id' => $id]
        );

        $command = RegisterRecruiterCommand::fromData($data);
        $errors = $this->validator->validate($command);
        if ($errors->count() > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        $this->bus->dispatch($command);

        return new JsonResponse(json_encode(['id' => $id]), Response::HTTP_CREATED);
    }
}
