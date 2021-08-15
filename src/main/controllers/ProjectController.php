<?php

namespace src\main\controllers;
require_once("../controllers/DatabaseController.php");




class ProjectController
{
    private DatabaseController $db;

    public function __construct()
    {
        $this->db = new DatabaseController();
    }

    public function newProject(){

        $ProjectId = (isset($_POST["ProjectID"])&& is_numeric($_POST["ProjectID"])) ? $_POST["ProjectID"] : "";
        $ProjectName = (isset($_POST["ProjectName"])&& is_numeric($_POST["ProjectName"])) ? $_POST["ProjectName"] : "";
        $ProjectDescription = (isset($_POST["ProjectDescription"])&& is_numeric($_POST["ProjectDescription"])) ? $_POST["ProjectDescription"] : "";
        $query = "INSERT INTO `project` (`PROJECT_ID`, `PROJECTNAME`, `DESCRIPTION`) VALUES
                  ($ProjectId,'$ProjectName','$ProjectDescription')";
        $this->db->UpdateDB($query);
    }

    public function editProject(){

    }

    public function deleteProject(){

    }
}