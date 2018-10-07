<?php

namespace App\App\Query;

/**
 * Class GetQuestionQuery
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class GetQuestionQuery
{
    /** @var array */
    private $payload;

    /**
     * @param array
     */
    public function __construct(array $data)
    {
        $this->payload = $data;
    }

    /**
     * @param string $identifier
     *
     * @return GetQuestionQuery
     */
    public static function fromIdentifier(string $identifier): GetQuestionQuery
    {
        return new self(['id' => $identifier]);
    }

    public function getId(): string
    {
        return $this->payload['id'];
    }
}
