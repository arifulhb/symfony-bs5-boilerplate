<?php

namespace App\Validator;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UserHandleValidator extends ConstraintValidator
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\UserHandle $constraint */

        if (null === $value || '' === $value) {
            return;
        }
        $authUser = $this->security->getUser();

        $handleCount = $this->em->getRepository(User::class)
            ->countHandles($authUser->getEmail(), $value);

        // TODO: implement the validation here
        if ($handleCount > 0) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
