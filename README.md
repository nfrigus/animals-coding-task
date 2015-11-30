“animals” coding task
=====================


## Task definition

Text could be found [here](doc/task.md).
And example input files here: `doc/input-example`

## Installation

    php composer.phar install

## Usage

    php app.php parse doc/input-example/input.txt
    php app.php parse doc/input-example/input2.txt

## Test

    vendor/bin/phpunit --bootstrap app/loader.php test
