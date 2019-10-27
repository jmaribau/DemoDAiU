<?php

declare(strict_types=1);

namespace Filter\Validator\Strategy;

use Filter\Validator\ValidatorInterface;

/**
 * Class FloatStrategy.
 */
class FloatStrategy implements ValidatorInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * FloatStrategy constructor.
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
        return filter_var($this->value, FILTER_VALIDATE_FLOAT);
    }
}
