<?php

declare(strict_types=1);

namespace Filter\Sanitizer\Strategy;

use Filter\Sanitizer\SanitizerInterface;

/**
 * Class ArrayOfIntegersStrategy.
 */
class ArrayOfIntegersStrategy implements SanitizerInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * ArrayOfIntegersStrategy constructor.
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
        return array_map('intval', $this->value);
    }
}
