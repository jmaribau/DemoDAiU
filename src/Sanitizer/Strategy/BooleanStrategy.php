<?php

declare(strict_types=1);

namespace Filter\Sanitizer\Strategy;

use Filter\Sanitizer\SanitizerInterface;

/**
 * Class BooleanSanitizerStrategy.
 */
class BooleanStrategy implements SanitizerInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * BooleanSanitizerStrategy constructor.
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
    public function sanitize()
    {
        return filter_var($this->value, FILTER_UNSAFE_RAW);
    }
}
