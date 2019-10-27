<?php

declare(strict_types=1);

namespace App\Validator\Strategy;

/**
 * Class Sanitizer.
 */
interface ValidatorStrategyInterface
{
    public function filter();
}
