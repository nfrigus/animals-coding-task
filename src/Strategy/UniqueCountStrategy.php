<?php

namespace App\Strategy;

use App\Strategy\StrategyInterface;


class UniqueCountStrategy implements StrategyInterface
{
    private $items = array();

    public function addItem($item)
    {
        if (!isset($this->items[$item])) {
            $this->items[$item] = 0;
        }

        return ++$this->items[$item];
    }

    public function getResult()
    {
        $out = array();

        foreach ($this->items as $item => $occurrences) {
            $out[] = sprintf("%s: %d", $item, $occurrences);
        }

        return implode("\n", $out);
    }
}
