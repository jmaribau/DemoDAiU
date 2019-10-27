<?php

declare(strict_types=1);

namespace App\Validator;

/**
 * Class ValidatorStrategyFactory.
 */
class ValidatorStrategyFactory
{
    /**
     * @param array $input
     *
     * @throws ValidatorStrategyFactoryException
     *
     * @return mixed
     */
    public static function build(array $input)
    {
        $validator = 'App\Validator\Strategy\Strategies\\'.ucwords($input['type']).'ValidatorStrategy';

        if (\class_exists($validator)) {
            return new $validator($input['value']);
        }

        throw new ValidatorStrategyFactoryException('Invalid validator type given.');
    }
}
