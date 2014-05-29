<?php # tests/CalculatorTest.php

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider additionDataProvider
     * @test
     */
    public function it_adds_2_and_2_together_correctly($x, $y, $result)
    {
        $calc = new Calculator();

        $this->assertEquals($calc->add($x, $y), $result);
    }

    public function additionDataProvider()
    {
        return array(
            "2 and 2" => array(2, 2, 4),
            "3 and 1" => array(3, 1, 4),
            "6 and 2" => array(6, 2, 8),
        );
    }
}
