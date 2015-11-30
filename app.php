<?php

require 'app/loader.php';

$engine = new \App\ParseEngine;
$engine->register('ANIMALS', new \App\Strategy\SortedUniqueStrategy);
$engine->register('NUMBERS', new \App\Strategy\UniqueCountStrategy);
$engine->register('CARS', new \App\Strategy\ReverseSortedUniqueHashStrategy);

$app = new \Cilex\Application('Cilex');
$app->command(new \App\Command\ParseCommand($engine));
$app->run();
