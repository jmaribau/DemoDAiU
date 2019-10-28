<?php

declare(strict_types=1);

namespace Filter;

/**
 * Interface FilterInterface.
 */
interface FilterInterface
{
    /**
     * @param mixed[] $request
     *
     * @return mixed
     */
    public static function execute(array $request);
}
