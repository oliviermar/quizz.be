<?php

namespace App\Domain\Serializer;

/**
 * Interface QuestionSerializerInterface
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
interface QuestionSerializerInterface
{
    /**
     * @param mixed $question
     *
     * @return string
     */
    public function serialize($question): string;
}
