<?php

require_once("../controllers/DatabaseController.php");




class ProjectController
{
    private DatabaseController $db;
    private $ProjectId;
    private $ProjectName;
    private $ProjectDescription;

    public function __construct()
    {
        $this->db = new DatabaseController();
        $this->ProjectId = (isset($_POST["ProjectID"])&& is_numeric($_POST["ProjectID"])) ? $_POST["ProjectID"] : "";
        $this->ProjectName = (isset($_POST["ProjectName"])&& is_string($_POST["ProjectName"])) ? $_POST["ProjectName"] : "";
        $this->ProjectDescription = (isset($_POST["ProjectDescription"])&& is_string($_POST["ProjectDescription"])) ? $_POST["ProjectDescription"] : "";
    }

    public function newProject(){
        $query = "INSERT INTO `project` (`PROJECT_ID`, `PROJECTNAME`, `DESCRIPTION`) VALUES
                  ($this->ProjectId,'$this->ProjectName','$this->ProjectDescription')";
        $this->db->UpdateDB($query);
    }

    public function editProject(){

        $query = "UPDATE `timetool`.`project` 
                  SET 
                    `PROJECTNAME` = '$this->ProjectName',
                    `DESCRIPTION` = '$this->ProjectDescription' 
                  WHERE (`PROJECT_ID` = $this->ProjectId)";
        $this->db->UpdateDb($query);
    }

    public function deleteProject(){

    }
}