<?php

declare(strict_types=1);

namespace Filter\Validator;

/**
 * Class Sanitizer.
 */
interface ValidatorInterface
{
    /**
     * @return bool|mixed
     */
    public function validate();
}
