<?php

declare(strict_types=1);

namespace App\Validator;

/**
 * Interface ValidatorInterface.
 */
interface ValidatorInterface
{
    /**
     * @param array $request
     *
     * @return mixed
     */
    public static function execute(array $request);
}
