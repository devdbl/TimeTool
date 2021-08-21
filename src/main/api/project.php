<?php

require_once("../controllers/ProjectController.php");
require_once("../tools/DatabaseConnector.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ($uri[2] !== 'project.php') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$projectId = null;
if (isset($_GET['id'])) {
    $projectId = $_GET['id'];
}

$getDeactivatedProjects = null;
if (isset($_GET['getDeactivatedProjects'])){
    $getDeactivatedProjects = $_GET['getDeactivatedProjects'];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$dbConnection = (new DatabaseConnector())->connect();

$projectController = new ProjectController($dbConnection, $requestMethod, $projectId, $getDeactivatedProjects);
$projectController->processRequest();

