<?php
require_once("../controllers/DatabaseController.php");

$db = new DatabaseController;
$sql="SELECT * FROM project";
$db->Query($sql);
echo json_encode($db->Rows());

$boolean = false;



