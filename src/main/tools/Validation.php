<?php

class Validation
{

    public function validateInput($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        return htmlspecialchars($data);
    }

    public function validatePerson($data){
        if (! isset($data['firstname'])) {
            return false;
        }
        if (! isset($data['lastname'])) {
            return false;
        }
        if (! isset($data['personalId'])) {
            return false;
        }
        if (! isset($data['shortname'])) {
            return false;
        }
        return true;
    }

    public function validateDate($data){
        if (! isset($data['startDate'])) {
            $month = strtotime("-1 Month");
            $data['startDate'] = date("Y-m-d",$month);
        }
        if (! isset($data['endDate'])) {
            $data['endDate'] = date("Y-m-d");
        }
        return $data;
    }
}