<?php

declare(strict_types=1);

namespace App\Sanitizer;

/**
 * Class SanitizerStrategyFactory.
 */
class SanitizerStrategyFactory
{
    /**
     * @param array $input
     *
     * @throws SanitizerStrategyFactoryException
     *
     * @return mixed
     */
    public static function build(array $input)
    {
        $sanitizer = 'App\Sanitizer\Strategy\Strategies\\'.ucwords($input['type']).'SanitizerStrategy';

        if (class_exists($sanitizer)) {
            return new $sanitizer($input['value']);
        }

        throw new SanitizerStrategyFactoryException('Invalid sanitizer type given.');
    }
}
