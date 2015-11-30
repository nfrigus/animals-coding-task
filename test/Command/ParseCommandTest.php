<?php

class ParseCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $input_file = uniqid();
        $output_val = uniqid();

        $engine = $this->getMock('App\ParseEngine');
        $engine->expects($this->once())->method('parseFile')->with($this->equalTo($input_file));
        $engine->expects($this->once())->method('getResult')->will($this->returnValue($output_val));

        $in = $this->getMock('Symfony\Component\Console\Input\InputInterface');
        $in->expects($this->once())->method('getArgument')->with($this->equalTo('file'))->will($this->returnValue($input_file));

        $out = $this->getMock('Symfony\Component\Console\Output\OutputInterface');
        $out->expects($this->once())->method('write')->with($this->equalTo($output_val));

        $command = new \App\Command\ParseCommand($engine);
        $command->execute($in, $out);
    }
}
