<?php

declare(strict_types=1);

namespace App\Sanitizer;

/**
 * Class Sanitizer.
 */
class Sanitizer implements SanitizerInterface
{
    /**
     * @param array $item
     *
     * @throws SanitizerStrategyFactoryException
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function execute(array $item)
    {
        $sanitizer = SanitizerStrategyFactory::build($item);

        return  $sanitizer->filter();
    }
}
