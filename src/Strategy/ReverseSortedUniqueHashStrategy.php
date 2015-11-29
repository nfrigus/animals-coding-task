<?php

namespace App\Strategy;

use App\Strategy\StrategyInterface;


class ReverseSortedUniqueHashStrategy implements StrategyInterface
{
    private $items = array();

    public function addItem($item)
    {
        $item = strtolower($item);

        return $this->items[$item] = md5($item);
    }

    public function getResult()
    {
        krsort($this->items);

        $out = array();

        foreach ($this->items as $item => $hash) {
            $out[] = sprintf('§  %s (%s)', $item, $hash);
        }

        return implode("\n", $out);
    }
}
