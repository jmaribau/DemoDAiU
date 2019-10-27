<?php

declare(strict_types=1);

namespace Filter\Sanitizer\Strategy;

use Filter\Sanitizer\SanitizerInterface;

/**
 * Class DateSanitizerStrategy.
 */
class DateStrategy implements SanitizerInterface
{
    public const DATESTRATEGY_FORMAT = 'Y-m-d';

    /**
     * @var mixed;
     */
    private $value;

    /**
     * @var string
     */
    private $format;

    /**
     * DateSanitizerStrategy constructor.
     *
     * @param mixed $value
     * @param string $format
     */
    public function __construct($value, string $format = self::DATESTRATEGY_FORMAT)
    {
        $this->value = $value;
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function sanitize()
    {
        $datetime = date_create($this->value);
        if (! $datetime) {
            return false;
        }
        return $datetime->format($this->format);
    }
}
