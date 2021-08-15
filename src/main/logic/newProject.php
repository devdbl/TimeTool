<?php

    require_once("../controllers/ProjectController.php");

    $NewProject = new ProjectController();

    $NewProject->newProject();
echo "<b>Projekt gespeichert</b><br>";
echo "<a href='../index.html'>go back</a>";
