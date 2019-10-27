<?php

declare(strict_types=1);

namespace Filter\Sanitizer;

/**
 * Interface SanitizerInterface.
 */
interface SanitizerInterface
{
    /**
     * @return mixed
     */
    public function sanitize();
}
