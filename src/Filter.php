<?php

declare(strict_types=1);

namespace Filter;

use Filter\Sanitizer\SanitizerFactory;
use Filter\Sanitizer\SanitizerFactoryException;
use Filter\Validator\ValidatorFactory;
use Filter\Validator\ValidatorFactoryException;

/**
 * Class Filter.
 */
final class Filter implements FilterInterface
{
    /**
     * @var bool
     */
    private $exception = false;

    /**
     * @param mixed[] $requestParameters
     *
     * @throws FilterException
     * @throws FilterNotFoundException
     */
    public function execute(array $requestParameters): void
    {
        $input = [];
        foreach ($requestParameters as $name => $item) {
            $input[$name] = $this->check($item);
        }

        if (true === $this->exception) {
            throw new FilterException('Invalid data', 0, null, $input);
        }
    }

    /**
     * @param mixed[] $item
     *
     * @throws FilterNotFoundException
     *
     * @return bool|mixed
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function check(array $item)
    {
        try {
            $validator = ValidatorFactory::build($item);
            $filter = $validator->validate();
            if (false !== $filter) {
                return $filter;
            }

            $this->exception = true;
            $sanitizer = SanitizerFactory::build($item);

            return $sanitizer->sanitize();
        } catch (ValidatorFactoryException | SanitizerFactoryException $exception) {
            throw new FilterNotFoundException($exception->getMessage(), 0, $exception);
        }
    }
}
