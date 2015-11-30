<?php

use App\ParseEngine;


class ParseEngineTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $engine = new ParseEngine;

        $strategy1 = $this->getMock('App\Strategy\StrategyInterface');
        $strategy2 = $this->getMock('App\Strategy\UniqueCountStrategy');

        $engine->register('S1', $strategy1);
        $engine->register('S2', $strategy2);

        $expected = array(
            'S1' => $strategy1,
            'S2' => $strategy2,
        );

        $this->assertAttributeEquals($expected, 'strategies', $engine,
            'ParseEngine should have all registered strategies.');
        $this->assertAttributeEquals($strategy2, 'current_strategy', $engine,
            'Expected ParseEngine::current_strategy to equal last registered strategy.');
    }

    public function testParseFile()
    {
        $engine = new ParseEngine;

        $strategy1 = $this->getMock('App\Strategy\StrategyInterface');
        $strategy2 = $this->getMock('App\Strategy\StrategyInterface');

        $strategy1->expects($this->exactly(2))->method('addItem')->with($this->equalTo("s1"));
        $strategy2->expects($this->exactly(3))->method('addItem')->with($this->equalTo("s2"));

        $engine->register('S1', $strategy1);
        $engine->register('S2', $strategy2);

        $fname = tempnam('/tmp', 'test');
        $content = implode("\n", array(
            "s2",
            "S1", "s1", "s1",
            "S2", "s2", "s2",
        ));
        file_put_contents($fname, $content);

        $engine->parseFile($fname);
        unlink($fname);
    }

    public function testGetResult()
    {
        $engine = new ParseEngine;

        $strategy1 = $this->getMock('App\Strategy\StrategyInterface');
        $strategy2 = $this->getMock('App\Strategy\StrategyInterface');

        $strategy1->expects($this->once())->method('getResult')->will($this->returnValue('S1_result'));
        $strategy2->expects($this->once())->method('getResult')->will($this->returnValue('S2_result'));

        $engine->register('S1_group', $strategy1);
        $engine->register('S2_groep', $strategy2);

        $expected = "S1_group:\nS1_result\n\nS2_groep:\nS2_result";

        $this->assertEquals($expected, $engine->getResult(),
            'ParseEngine::getResult returned unexpected value.');
    }
}
