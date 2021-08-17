<?php

class Validation
{

    public function testInput($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        return htmlspecialchars($data);
    }
}