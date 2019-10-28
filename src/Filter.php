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
     */
    private function check(array $item)
    {
        try {
            $filter = $this->validation($item);
            if (false !== $filter) {
                return $filter;
            }

            return $this->sanitation($item);
        } catch (ValidatorFactoryException | SanitizerFactoryException $exception) {
            throw new FilterNotFoundException($exception->getMessage(), 0, $exception);
        }
    }

    /**
     * @param mixed[] $item
     *
     * @throws ValidatorFactoryException
     *
     * @return mixed
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function validation(array $item)
    {
        $validator = ValidatorFactory::build($item);

        return $validator->validate();
    }

    /**
     * @param mixed[] $item
     *
     * @throws SanitizerFactoryException
     *
     * @return mixed
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function sanitation(array $item)
    {
        $this->exception = true;
        $sanitizer = SanitizerFactory::build($item);

        return $sanitizer->sanitize();
    }
}
