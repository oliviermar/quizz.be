<?php

namespace App\App\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * class RegisterRecruiterCommand
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class RegisterRecruiterCommand
{
    /** @var string */
    private $id;

    /** @var string */
    private $companyName;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /**
     * RegisterRecruiterCommand constructor
     *
     * @param UuidInterface $id
     * @param string        $companyName
     * @param string        $email
     * @param string        $password
     */
    public function __construct(UuidInterface $id, string $companyName, string $email, string $password)
    {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * RegisterRecruiterCommand static constructor
     *
     * @param array $data
     */
    public static function fromData(array $data)
    {
        return new self(
            $data['id'],
            $data['company_name'],
            $data['email'],
            $data['password']
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
