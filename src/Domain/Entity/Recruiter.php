<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * class Recruiter
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class Recruiter implements UserInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
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
        $this->plainPassword = $password;
    }

    /**
     * @param string $password
     *
     * @return Recruiter
     */
    public function setEncodedPassword(string $password)
    {
        $this->password = $password;
        $this->plainPassword = null;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @var string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return ['ROLE_RECRUITER'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->plainPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
