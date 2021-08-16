<?php
include_once ("../main/logic/Simple.php");
class ProjectControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testDivide()
    {
        $simple = new Simple(10);
        $result = $simple->divide(2);

        $this->assertEquals(5, $result);
    }


    /*public function testDivideWithException()
    {
        $simple = new Simple(10);
        $simple->divide(0);

    }*/

}