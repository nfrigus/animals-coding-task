<?php

class UniqueCountStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResult()
    {
        $strategy = new \App\Strategy\UniqueCountStrategy;

        $strategy->addItem('b');
        $strategy->addItem('b');
        $strategy->addItem('a');

        $expected = "b: 2\na: 1";

        $this->assertEquals($expected, $strategy->getResult());
    }
}
