<?php

namespace Kanboard\Validator;

use SimpleValidator\Validator;
use SimpleValidator\Validators;

class PredefinedTaskDescriptionValidator extends BaseValidator
{
    public function validate(array $values)
    {
        $v = new Validator($values, [
            new Validators\Required('title', t('This value is required')),
            new Validators\Required('description', t('This value is required')),
        ]);

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }
}
