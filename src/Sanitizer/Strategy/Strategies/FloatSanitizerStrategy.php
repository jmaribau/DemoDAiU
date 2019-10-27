<?php

declare(strict_types=1);

namespace App\Sanitizer\Strategy\Strategies;

use App\Sanitizer\Strategy\SanitizerStrategyInterface;

/**
 * Class FloatSanitizerStrategy.
 */
class FloatSanitizerStrategy implements SanitizerStrategyInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * FloatSanitizerStrategy constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function filter()
    {
        return filter_var($this->value, FILTER_SANITIZE_NUMBER_FLOAT);
    }
}
