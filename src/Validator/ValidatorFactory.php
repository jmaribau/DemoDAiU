<?php

declare(strict_types=1);

namespace Filter\Validator;

/**
 * Class ValidatorFactory.
 */
class ValidatorFactory
{
    /**
     * @param mixed[] $input
     *
     * @throws ValidatorFactoryException
     *
     * @return mixed
     */
    public static function build(array $input)
    {
        $strategy = preg_replace('/\s+/', '', ucwords($input['type'])).'Strategy';
        $validator = __NAMESPACE__.'\Strategy\\'.$strategy;

        if (class_exists($validator)) {
            return new $validator($input['value']);
        }

        throw new ValidatorFactoryException(
            'Invalid type "'.$input['type'].'" given for validator "'.$validator.'" .'
        );
    }
}
