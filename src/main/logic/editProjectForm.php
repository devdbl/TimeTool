<?php
require_once("../controllers/ProjectController.php");

$EditProject = new ProjectController();
$EditProject->editProject();

echo "<b>Projekt aktualisiert</b><br>";
echo "<a href='../index.html'>go back</a>";