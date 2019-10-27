<?php

declare(strict_types=1);

namespace Filter;

use Filter\Sanitizer\SanitizerFactory;
use Filter\Validator\ValidatorFactory;

/**
 * Class Filter.
 */
class Filter implements FilterInterface
{
    private static $exception = false;

    /**
     * @param array $requestParameters
     *
     * @throws Sanitizer\SanitizerFactoryException
     * @throws Validator\ValidatorFactoryException
     * @throws FilterException
     */
    public static function execute(array $requestParameters): void
    {
        $input = [];
        foreach ($requestParameters as $name => $item) {
            $input[$name] = self::check($item);
        }

        if (true === self::$exception) {
            throw new FilterException('Invalid data', 0, null, $input);
        }
    }

    /**
     * @param array $item
     *
     * @throws Sanitizer\SanitizerFactoryException
     * @throws Validator\ValidatorFactoryException
     *
     * @return bool|mixed
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private static function check(array $item)
    {
        $validator = ValidatorFactory::build($item);
        $filter = $validator->validate();
        if (false !== $filter) {
            return $filter;
        }

        self::$exception = true;
        $sanitizer = SanitizerFactory::build($item);

        return $sanitizer->sanitize();
    }
}
