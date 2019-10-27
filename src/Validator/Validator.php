<?php

declare(strict_types=1);

namespace App\Validator;

use App\Sanitizer\SanitizerStrategyFactory;
use App\Sanitizer\SanitizerStrategyFactoryException;

/**
 * Class Validator.
 */
class Validator implements ValidatorInterface
{
    /**
     * @param array $request
     *
     * @throws ValidatorStrategyFactoryException
     * @throws SanitizerStrategyFactoryException
     *
     * @return array
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function execute(array $request): array
    {
        $out = [];
        foreach ($request as $item) {
            $validator = ValidatorStrategyFactory::build($item);
            $filter = $validator->filter();
            if (false === $filter) {
                $sanitizer = SanitizerStrategyFactory::build($item);
                $filter = $sanitizer->filter();
            }
            $out[$item['name']] = $filter;
        }

        return $out;
    }
}
