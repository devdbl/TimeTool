<?php
require_once("../controllers/DatabaseController.php");

$db = new DatabaseController;
$db->SelectAll("project");

$boolean = false;



