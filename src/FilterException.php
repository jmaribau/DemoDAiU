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
     * @var array
     */
    private $input;

    /**
     * FilterException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param null|Exception $previous
     * @param array          $input
     */
    public function __construct($message, $code = 0, Exception $previous = null, $input = ['params'])
    {
        parent::__construct($message, $code, $previous);
        $this->input = $input;
    }

    /**
     * @return mixed[]
     */
    public function getInput(): array
    {
        return $this->input;
    }
}
