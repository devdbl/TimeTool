<?php

use PHPUnit\Framework\TestCase;

require_once("../main/tools/Validation.php");

class ValidationTest extends TestCase
{
    public function testValidateInputTrim(){
        $data = "  hello   ";
        $validInput = new Validation();
        $data = $validInput->validateInput($data);
        $this->assertEquals("hello", $data);
    }

    public function testValidateInputStripcslashes(){
        $data = '\hello';
        echo stripcslashes($data);
        $validInput = new Validation();
        $data = $validInput->validateInput($data);
        $this->assertEquals("hello", $data);
    }

    public function testValidateInputHtmlspecialchars(){
        $data = 'hi & <b>welcome</b> \"';
        $validInput = new Validation();
        $data = $validInput->validateInput($data);
        $this->assertEquals("hi &amp; &lt;b&gt;welcome&lt;/b&gt; &quot;", $data);
    }

    public function testValidateDateGetActualDateMinusOneMonth(){
        $date['startDate'] = null;
        $date['endDate'] = null;
        $validDate = new Validation();
        $actual = $validDate->validateDate($date);

        $expected = date("Y-m-d",strtotime("-1 Month"));

        $this->assertEquals(date("Y-m-d"),$actual['endDate']);
        $this->assertEquals($expected, $actual['startDate']);
        $this->assertNotNull($actual);
    }

    public function testValidateDatePassDates(){
        $date['startDate'] = "2021-03-31";
        $date['endDate'] = "2019-12-06";
        $validDate = new Validation();
        $actual = $validDate->validateDate($date);

        $this->assertEquals("2019-12-06",$actual['endDate']);
        $this->assertEquals("2021-03-31", $actual['startDate']);
        $this->assertNotNull($actual);
    }

    public function testValidatePersonAllParametersOk(){
        $data['firstname'] = "Mike";
        $data['lastname'] = "Tester";
        $data['personalId'] = 9999;
        $data['shortname'] = "Mike";
        $validPerson = new Validation();

        $actual = $validPerson->validatePerson($data);

        $this->assertTrue($actual);

    }

}
