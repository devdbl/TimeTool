<?php
require_once("../models/User.php");
require_once("../controllers/Validation.php");
require_once("../controllers/DatabaseController.php");

use Webmozart\Assert\Assert;

class EmployeeController
{
    private user $user;

    public function __construct()
    {
        $this->user = new User();
        $this->valid = new Validation();
        $this->db = new DatabaseController();
    }

    public function addEmployee(){
        $this->user->setFirstname($this->valid->testInput((isset($_POST["firstname"]))));
        $this->user->setLastname($this->valid->testInput((isset($_POST["lastname"]))));
        $this->user->setPersonalId($this->valid->testInput((isset($_POST["personalId"]))));
        $this->user->setShortname($this->valid->testInput((isset($_POST["shortname"]))));
        $this->user->setEmail($this->valid->testInput((isset($_POST["email"]))));
        $sql = "INSERT INTO `employee` (`EMPLOYEE_ID`, `FIRSTNAME`, `LASTNAME`, `SHORTNAME`, `PASSWORD`, `ROLE`, `CREATED`, `UPDATED`) VALUES
                ($this->user->getPersonalId(),'$this->user->getFirstname()','$this->user->getLastname()',$this->user->getShortname(),'$this->user->getPasword()',$this->user->getRole(),timestamp ,timestamp )";
        $this->db->UpdateDb($sql);
    }

    public function editEmployee($personalId){

        $query = "UPDATE `timetool`.`employee` 
                  SET 
                    `PROJECTNAME` = '$this->ProjectName',
                    `DESCRIPTION` = '$this->ProjectDescription' 
                  WHERE (`PROJECT_ID` = $this->ProjectId)";
        $this->db->UpdateDb($query);
    }

    public function deleteEmployee($personalId){

    }
}