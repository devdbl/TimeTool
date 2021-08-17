<?php
require_once("../controllers/ReportController.php");
require_once("../tools/DatabaseConnector.php");


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ($uri[2] !== 'employee.php') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$projectId = null;
if (isset($_GET['projectId'])) {
    $projectId = $_GET['projectId'];
}
$userId = null;
if (isset($_GET['userId'])){
    $userId = $_GET['userId'];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$dbConnection = (new DatabaseConnector())->connect();

$reportController = new ReportController($dbConnection, $requestMethod, $projectId, $userId);
$reportController->processRequest();