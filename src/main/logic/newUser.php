<?php
require_once ("../controllers/EmployeeController.php");

$dbConnection = (new DatabaseConnector())->getConnection();



$employee = new EmployeeController();





echo "<h1>".$employee->addEmployee()."</h1>";

echo "<b>Mitarbeiter gespeichert</b><br>";
echo "<a href='../index.html'>go back</a>";
