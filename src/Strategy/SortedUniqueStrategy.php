<?php

namespace App\Strategy;

use App\Strategy\StrategyInterface;


class SortedUniqueStrategy implements StrategyInterface
{
    private $items = array();

    public function addItem($item)
    {
        return $this->items[$item] = true;
    }

    public function getResult()
    {
        ksort($this->items);

        return implode("\n", array_keys($this->items));
    }
}
