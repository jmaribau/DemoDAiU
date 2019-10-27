<?php

declare(strict_types=1);

namespace Filter;

use Exception;

/**
 * Class FilterException.
 */
class FilterException extends Exception
{
    /**
     * @var array $input
     */
    private $input;

    /**
     * FilterException constructor.
     * @param $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $input
     */
    public function __construct($message, $code = 0, Exception $previous = null, $input = array('params'))
    {
        parent::__construct($message, $code, $previous);
        $this->input = $input;
    }

    /**
     * @return array
     */
    public function getInput(): array
    {
        return $this->input;
    }
}
