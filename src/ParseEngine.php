<?php

namespace App;

use App\Strategy\StrategyInterface as Strategy;


class ParseEngine
{
    private $strategies = array();
    private $current_strategy;
    private $filename;


    public function register($category, Strategy $strategy)
    {
        $this->strategies[$category] = $strategy;
        $this->current_strategy = $strategy;
    }

    public function parseFile($filename)
    {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $value) {
            isset($this->strategies[$value])
                and $this->current_strategy = $this->strategies[$value]
                or $this->current_strategy->addItem($value);
        }
    }

    public function getResult()
    {
        $out = array();

        foreach ($this->strategies as $group_name => $strategy) {
            $out[] = sprintf("%s:\n%s", $group_name, $strategy->getResult());
        }

        return implode("\n\n", $out);
    }
}
