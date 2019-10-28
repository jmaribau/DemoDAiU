## Description
Validator & Sanitizer of input parameters

## Requirements
````
php ^7.2
````

## Install
````
$ git clone https://github.com/jmaribau/DemoDAiU.git
$ cd DemoDAiU
$ composer install
````

## Use
`$ php index.php`

## Index.php
#### Code
````
<?php

declare(strict_types=1);

namespace App;

use Filter\Filter;
use Filter\FilterException;
use Filter\Validator\ValidatorFactoryException;
use Filter\Sanitizer\SanitizerFactoryException;
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

Filter::execute($requestParameters);

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
    Filter::execute($requestParameters);
} catch (FilterException $fe) {
    echo 'Captured Exception'.PHP_EOL;
    print_r($fe->getInput());
}


$requestParameters = [
    'param_10' => [
        'name' => 'param_10',
        'type' => 'age',
        'value' => '30',
    ],
];

try {
    Filter::execute($requestParameters);
} catch (ValidatorFactoryException $vfe) {
    echo $vfe->getMessage();
} catch (SanitizerFactoryException $sfe) {
    echo $sfe->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}
````
#### Result
````
λ php index.php
Captured Exception
Array
(
    [param_9] => 2019-10-27
    [param_9.1] => 2019-03-02
    [param_9.2] => 2019-02-01
)

Invalid type "age" given for validator "Filter\Validator\Strategy\AgeStrategy" .
````
## Quality Tools

#### PHPLint
Type `$ composer qa-phpint`
````
λ composer qa-phplint
> php vendor/overtrue/phplint/bin/phplint src/ tests/ -c build/.phplint.yml
phplint 1.0.2 by overtrue and contributors.

Loaded config from "build/.phplint.yml"

..........

Time: < 1 sec   Memory: 2.0 MiB Cache: Yes

OK! (Files: 27, Success: 27)
````

#### PHPCodeSniffer
Type `$ composer qa-phpcs`
````
λ composer qa-phpcs
> php vendor/squizlabs/php_codesniffer/bin/phpcs src/ tests/ -p --colors --cache --standard=PSR1,PSR2
........................... 27 / 27 (100%)


Time: 454ms; Memory: 6MB
````

#### PHPCodeStandardFixer
Type `$ composer qa-phcsf`
````
λ composer qa-phpcsf
> php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache
Loaded config default.
Using cache file "build/.php_cs.cache".
SSSSSS..SSSSSSS
Checked all files in 0.342 seconds, 12.000 MB memory used
SSSSSSSSSSSS
Legend: ?-unknown, I-invalid file syntax, file ignored, S-Skipped, .-no changes, F-fixed, E-error
> php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache
Loaded config default
Checked all files in 0.001 seconds, 10.000 MB memory used
.
Using cache file "build/.php_cs.cache".

Legend: ?-unknown, I-invalid file syntax, file ignored, S-Skipped, .-no changes, F-fixed, E-error
````

#### PHPStan
Type `$ composer qa-phpstan`
````
λ composer qa-phpstan
> php vendor/phpstan/phpstan/bin/phpstan analyse src/ --level 7 -c build/phpstan.neon

 27/27 [============================] 100%
````

#### PHPMessDetector
Type `$ composer qa-phpmd`
````
λ composer qa-phpmd
> php vendor/phpmd/phpmd/src/bin/phpmd src/ text build/phpmd.xml
````

#### PHPCopyPasteDetector
Type `$ composer qa-phpcpd`
````
λ composer qa-phpcpd
> php vendor/sebastian/phpcpd/phpcpd src/ --min-lines 5 --min-tokens 70
phpcpd 4.1.0 by Sebastian Bergmann.

No clones found.

Time: 83 ms, Memory: 4.00 MB
````

#### Object Calisthenics
Type `$ composer qa-phpcs-calisthenics`
````
λ composer qa-phpcs-calisthenics
> php vendor/squizlabs/php_codesniffer/bin/phpcs src -sp --standard=vendor/object-calisthenics/phpcs-calisthenics-rules/src/ObjectCalisthenics/ruleset.xml
........................... 27 / 27 (100%)


Time: 739ms; Memory: 4MB
````


## Composer

#### Required
````
"require": {
        "php": "^7.2"
    },
    "require-dev": {
        "overtrue/phplint": "^1.1",
        "squizlabs/php_codesniffer": "^3.5",
        "friendsofphp/php-cs-fixer": "^2.15",
        "phpstan/phpstan": "^0.11.16",
        "phpmd/phpmd": "^2.7",
        "sebastian/phpcpd": "^4.1",
        "symfony/var-dumper": "^4.3",
        "slevomat/coding-standard": "^5.0",
        "object-calisthenics/phpcs-calisthenics-rules": "^3.5",
        "phpstan/phpstan-strict-rules": "^0.11.1",
        "thecodingmachine/phpstan-strict-rules": "^0.11.2",
        "pepakriz/phpstan-exception-rules": "^0.8.3",
        "localheinz/phpstan-rules": "^0.13.0"
    },
    "autoload": {
        "psr-4": {
            "Filter\\": "src/"
        }
    },
````

#### Scripts
````
"scripts": {
        "qa1": ["@qa-phplint", "@qa-phpstan", "@qa-phpmd", "@qa-phpcpd", "@qa-phpcs-calisthenics"],
        "qa2": ["@qa-phpcs", "@qa-phpcsf"],
        "qa3": ["@qa-phpcbf", "@qa-phpcsf-force"],

        "qa-phplint" : "php vendor/overtrue/phplint/bin/phplint src/ tests/ -c build/.phplint.yml",
        "qa-phpcs" : "php vendor/squizlabs/php_codesniffer/bin/phpcs src/ tests/ -p --colors --cache --standard=PSR1,PSR2",
        "qa-phpcbf": "php vendor/squizlabs/php_codesniffer/bin/phpcbf src/ tests/ --standard=PSR1,PSR2",
        "qa-phpcsf": [
            "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache",
            "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache"
        ],
      "qa-phpcsf-force": [
        "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --cache-file build/.php_cs.cache",
        "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --cache-file build/.php_cs.cache"
      ],
        "qa-phpstan" : "php vendor/phpstan/phpstan/bin/phpstan analyse src/ --level 7 -c build/phpstan.neon",
        "qa-phpmd" : [
            "php vendor/phpmd/phpmd/src/bin/phpmd src/ text build/phpmd.xml"
        ],
        "qa-phpcpd" : "php vendor/sebastian/phpcpd/phpcpd src/ --min-lines 5 --min-tokens 70",
        "qa-phpcs-calisthenics": "php vendor/squizlabs/php_codesniffer/bin/phpcs src -sp --standard=vendor/object-calisthenics/phpcs-calisthenics-rules/src/ObjectCalisthenics/ruleset.xml",
        "qa-phpcs-slevomat": "php vendor/squizlabs/php_codesniffer/bin/phpcs src -sp --standard=vendor/slevomat/coding-standard/SlevomatCodingStandard/ruleset.xml",
        "qa-phpcbf-slevomat": "php vendor/squizlabs/php_codesniffer/bin/phpcbf src -sp --standard=vendor/slevomat/coding-standard/SlevomatCodingStandard/ruleset.xml"
    }
````
