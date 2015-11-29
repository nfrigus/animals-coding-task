<?php

namespace App\Strategy;


interface StrategyInterface
{
    public function addItem($item);
    public function getResult();
}