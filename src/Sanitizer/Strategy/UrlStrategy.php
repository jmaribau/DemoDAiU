<?php

declare(strict_types=1);

namespace Filter\Sanitizer\Strategy;

use Filter\Sanitizer\SanitizerInterface;

/**
 * Class UrlSanitizerStrategy.
 */
class UrlStrategy implements SanitizerInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * UrlSanitizerStrategy constructor.
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
        return filter_var($this->value, FILTER_SANITIZE_URL);
    }
}
