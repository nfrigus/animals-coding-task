<?php

require 'app/loader.php';

$app = new \Cilex\Application('Cilex');
$app->command(new \App\Command\ParseCommand());
$app->run();
