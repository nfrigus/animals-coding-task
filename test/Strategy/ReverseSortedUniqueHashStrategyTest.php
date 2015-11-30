<?php

class ReverseSortedUniqueHashStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResult()
    {
        $strategy = new \App\Strategy\ReverseSortedUniqueHashStrategy;

        $strategy->addItem('BMW');
        $strategy->addItem('Vm');
        $strategy->addItem('vM');

        $expected =
            "§  vm (686c821a80914aef822465b48019cd34)\n".
            "§  bmw (71913f59e458e026d6609cdb5a7cc53d)";

        $this->assertEquals($expected, $strategy->getResult());
    }
}
