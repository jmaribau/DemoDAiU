<?php

declare(strict_types=1);

namespace App\Sanitizer\Strategy;

/**
 * Interface SanitizerStrategyInterface.
 */
interface SanitizerStrategyInterface
{
    /**
     * @return mixed
     */
    public function filter();
}
