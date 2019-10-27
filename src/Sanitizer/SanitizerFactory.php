<?php

declare(strict_types=1);

namespace Filter\Sanitizer;

/**
 * Class SanitizerFactory.
 */
class SanitizerFactory
{
    /**
     * @param array $input
     *
     * @throws SanitizerFactoryException
     *
     * @return mixed
     */
    public static function build(array $input)
    {
        $strategy = preg_replace('/\s+/', '', ucwords($input['type'])).'Strategy';
        $sanitizer = __NAMESPACE__ .'\Strategy\\'.$strategy;

        if (class_exists($sanitizer)) {
            return new $sanitizer($input['value']);
        }

        throw new SanitizerFactoryException(
            'Invalid type "'.$input['type'].'" given for validator "'.$sanitizer.'" .'
        );
    }
}
