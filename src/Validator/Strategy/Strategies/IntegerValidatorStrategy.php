<?php

declare(strict_types=1);

namespace App\Validator\Strategy\Strategies;

use App\Validator\Strategy\ValidatorStrategyInterface;

/**
 * Class IntegerValidatorStrategy.
 */
class IntegerValidatorStrategy implements ValidatorStrategyInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * IntegerValidatorStrategy constructor.
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
    public function filter()
    {
        return filter_var($this->value, FILTER_VALIDATE_INT);
    }
}