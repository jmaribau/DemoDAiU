<?php

declare(strict_types=1);

namespace Filter\Validator\Strategy;

use Filter\Validator\ValidatorInterface;

/**
 * Class EmailStrategy.
 */
class EmailStrategy implements ValidatorInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * EmailStrategy constructor.
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
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }
}
