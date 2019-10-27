<?php

declare(strict_types=1);

namespace App\Sanitizer;

/**
 * Interface SanitizerInterface.
 */
interface SanitizerInterface
{
    /**
     * @param array $request
     *
     * @return mixed
     */
    public static function execute(array $request);
}
