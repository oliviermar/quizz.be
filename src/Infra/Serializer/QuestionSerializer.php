<?php

namespace App\Infra\Serializer;

use App\Domain\Serializer\QuestionSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class QuestionSerializer
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class QuestionSerializer implements QuestionSerializerInterface
{
    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($question): string
    {
        return $this->serializer->serialize($question, 'json');
    }
}
