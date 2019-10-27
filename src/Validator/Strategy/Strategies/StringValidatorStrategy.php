<?php

declare(strict_types=1);

namespace App\Validator\Strategy\Strategies;

use App\Validator\Strategy\ValidatorStrategyInterface;

/**
 * Class StringValidatorStrategy.
 */
class StringValidatorStrategy implements ValidatorStrategyInterface
{
    /**
     * @var mixed;
     */
    private $value;

    /**
     * StringValidatorStrategy constructor.
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
        return filter_var($this->value, FILTER_UNSAFE_RAW);
    }
}
