<?php

namespace App\App\CommandHandler;

use App\App\Command\RegisterRecruiterCommand;
use App\Domain\Entity\Recruiter;
use App\Domain\Exception\EmailAlreadyUseException;
use App\Domain\Repository\RecruiterRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterRecruiterCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@icloud.com>
 */
class RegisterRecruiterCommandHandler
{
    /** @var RecruiterRepositoryInterface */
    private $recruiterRepository;

    /** @var UserPasswordEncoderInterface */
    private $encoder;

    /**
     * @param RecruiterRepositoryInterface $recruiterRepository
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(RecruiterRepositoryInterface $recruiterRepository, UserPasswordEncoderInterface $encoder)
    {
        $this->recruiterRepository = $recruiterRepository;
        $this->encoder = $encoder;
    }

    /**
     * @param RegisterRecruiterCommand $command
     */
    public function __invoke(RegisterRecruiterCommand $command)
    {
        $exist = $this->recruiterRepository->findOneBy(
            [
                'email' => $command->getEmail()
            ]
        );

        if ($exist instanceof Recruiter) {
            throw EmailAlreadyUseException::fromEmail($command->getEmail());
        }

        $recruiter = new Recruiter(
            $command->getId(),
            $command->getCompanyName(),
            $command->getEmail(),
            $command->getPassword()
        );

        $encodedPassword = $this->encoder->encodePassword($recruiter, $recruiter->getPassword());
        $recruiter->setEncodedPassword($encodedPassword);

        $this->recruiterRepository->save($recruiter);
    }
}
