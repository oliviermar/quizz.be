<?php

namespace App\Domain\Exception;

/**
 * Class QuestionNotFoundException
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class QuestionNotFoundException extends \Exception
{
    /**
     * @param string identifier
     *
     * @return QuestionNotFoundException
     */
    public static function fromIdentifier(string $identifier): QuestionNotFoundException
    {
        return new self(
            sprintf('Question with identifier %s was not found', $identifier)
        );
    }
}
