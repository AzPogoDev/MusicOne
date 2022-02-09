<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Address extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'La ville, le code postale et le pays ne correspondent pas frérot';

    public $message_bis = 'Le code postale corresponds à {{ postale }}';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
