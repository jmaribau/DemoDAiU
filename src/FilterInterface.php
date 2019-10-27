<?php

declare(strict_types=1);

namespace Filter;

/**
 * Interface FilterInterface.
 */
interface FilterInterface
{
    /**
     * @param array $request
     *
     * @return mixed
     */
    public static function execute(array $request);
}
