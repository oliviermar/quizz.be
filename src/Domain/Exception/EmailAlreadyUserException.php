<?php

namespace App\Domain\Exception;

/**
 * Class EmailAlreadyUseExeption
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class EmailAlreadyUseException extends \RuntimeException
{
    public static function fromEmail(string $email): EmailAlreadyUseException
    {
        return new self('Email already use');
    }
}
