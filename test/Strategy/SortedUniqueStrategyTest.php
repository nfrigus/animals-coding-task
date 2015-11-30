<?php

class SortedUniqueStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResult()
    {
        $strategy = new \App\Strategy\SortedUniqueStrategy;

        $strategy->addItem('b');
        $strategy->addItem('b');
        $strategy->addItem('a');

        $expected = "a\nb";

        $this->assertEquals($expected, $strategy->getResult());
    }
}
