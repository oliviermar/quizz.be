<?php

namespace App\Domain\Exception;

/**
 * Class CategoryNotFoundException
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class CategoryNotFoundException extends \Exception
{
    /**
     * @param string identifier
     *
     * @return CategoryNotFoundException
     */
    public static function fromIdentifier(string $identifier): CategoryNotFoundException
    {
        return new self(
            sprintf('Category with identifier %s was not found', $identifier)
        );
    }
}
