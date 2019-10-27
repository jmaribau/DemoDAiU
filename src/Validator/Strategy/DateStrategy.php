<?php

declare(strict_types=1);

namespace Filter\Validator\Strategy;

use Filter\Validator\ValidatorInterface;

/**
 * Class DateStrategy.
 */
class DateStrategy implements ValidatorInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * DateStrategy constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool|mixed
     */
    public function validate()
    {
        [$year,$month,$day] = sscanf($this->value, '%4d-%2d-%2d');
        return checkdate((int) $month, (int) $day, (int) $year) ? $this->value: false;
    }
}
