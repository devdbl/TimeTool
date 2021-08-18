<?php
include_once("../main/logic/Simple.php");

 /**
     * @group UnitTest
     */
class ProjectControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testDivide()
    {
        $simple = new Simple(10);
        $result = $simple->divide(2);

        $this->assertEquals(5, $result);
    }


    /*api function testDivideWithException()
    {
        $simple = new Simple(10);
        $simple->divide(0);

    }*/

}
