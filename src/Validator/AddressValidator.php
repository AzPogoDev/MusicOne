<?php

namespace App\Validator;

use App\Service\LocationService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AddressValidator extends ConstraintValidator
{
    private $locationService;

    public function __construct(LocationService $location)
    {
        $this->locationService = $location;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($this->locationService->checkAddress($value)) {
            return;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
