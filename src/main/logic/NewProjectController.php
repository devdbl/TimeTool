<?php
require("../controllers/DatabaseController.php");

$db = new DatabaseController();
$ProjectId = (isset($_POST["ProjectID"])&& is_numeric($_POST["ProjectID"])) ? $_POST["ProjectID"] : "99";
$ProjectName = (isset($_POST["ProjectName"])&& is_string($_POST["ProjectName"])) ? $_POST["ProjectName"] : "99";
$ProjectDescription = (isset($_POST["ProjectDescription"])&& is_string($_POST["ProjectDescription"])) ? $_POST["ProjectDescription"] : "";
$query = "INSERT INTO `project` (`PROJECT_ID`, `PROJECTNAME`, `DESCRIPTION`) VALUES
                  ($ProjectId,'$ProjectName','$ProjectDescription')";
$db->UpdateDb($query);
echo "<b>Projekt gespeichert</b><br>";
echo "<a href='../index.html'>go back</a>";
