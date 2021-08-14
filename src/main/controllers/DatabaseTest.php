<?php
require_once("../controllers/DatabaseController.php");
$db = new DatabaseController;
$db->Select("project");

