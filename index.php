<?php

declare(strict_types=1);

namespace App;

use Filter\Filter;
use Filter\FilterException;
use Filter\FilterNotFoundException;
use Exception;

require __DIR__ . '/vendor/autoload.php';

$requestParameters = [
    'param_1' => [
        'name' => 'param_1',
        'type' => 'integer',
        'value' => 10
    ],
    'param_2' => [
        'name' => 'param_2',
        'type' => 'float',
        'value' => 1.1,
    ],
    'param_3' => [
        'name' => 'param_3',
        'type' => 'string',
        'value' => 'hello',
    ],
    'param_4' => [
        'name' => 'param_4',
        'type' => 'boolean',
        'value' => true,
    ],
    'param_5' => [
        'name' => 'param_5',
        'type' => 'array of strings',
        'value' => ['a','b','c'],
    ],
    'param_6' => [
        'name' => 'param_6',
        'type' => 'array of integers',
        'value' => [1,2,3],
    ],
    'param_7' => [
        'name' => 'param_7',
        'type' => 'email',
        'value' => 'fake@email.com',
    ],
    'param_8' => [
        'name' => 'param_8',
        'type' => 'url',
        'value' => 'http://www.google.es',
    ],
    'param_9' => [
        'name' => 'param_9',
        'type' => 'date',
        'value' => '2019-10-27',
    ],
];

$filter = new Filter();
$filter->execute($requestParameters);

$requestParameters = [
    'param_9' => [
        'name' => 'param_9',
        'type' => 'date',
        'value' => '2019-10-27',
    ],
    'param_9.1' => [
        'name' => 'param_9.1',
        'type' => 'date',
        'value' => '2019-02-30',
    ],
    'param_9.2' => [
        'name' => 'param_9.1',
        'type' => 'date',
        'value' => '2019/02/01',
    ],
];

try {
    $filter = new Filter();
    $filter->execute($requestParameters);
} catch (FilterException $exception) {
    echo 'Captured Exception'.PHP_EOL;
    print_r($exception->getInput());
}


$requestParameters = [
    'param_10' => [
        'name' => 'param_10',
        'type' => 'age',
        'value' => '30',
    ],
];

try {
    $filter = new Filter();
    $filter->execute($requestParameters);
} catch (FilterNotFoundException $exception) {
    echo $exception->getMessage();
}