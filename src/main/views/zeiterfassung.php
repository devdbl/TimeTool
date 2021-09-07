<?php
require_once("../controllers/ReportController.php");
require_once("../tools/DatabaseConnector.php");
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Zeiterfassen");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();
$showForm = true;

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}elseif($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    setcookie(session_name(),"invalid",0,"/");
}else {

    echo $sidebar;

    if (isset($_GET['addReport'])) {
        $projectId = null;
        $userId = null;
        $dateArray['startDate'] = null;
        $dateArray['endDate'] = null;
        $overview = null;
        $requestMethod = 'ADD';
        $showForm = false;

        $_POST['personalId'] = $_SESSION['userid'];

        $dbConnection = (new DatabaseConnector())->connect();

        $reportController = new ReportController($dbConnection, $requestMethod, $projectId, $userId, $dateArray, $overview);
        $reportController->processRequest();

        echo "<div class='inhalt'</div>";
        echo "<h1>Buchung erstellt</h1>";
        echo "<h2>Gongrats!!</h2>";


    }

    if($showForm) {
        echo '
            <div class="inhalt">
                <h1>Zeiterfassen</h1>
                <form action="?addReport" method="post">
                    <div class="form-group">
                        <label for="projectId">Projekt</label>
                        <input type="number" class="form-control" id="projectId" name = "projectId">
                    </div>
                    <div class="form-group">
                        <label for="time">Geleistete Arbeit in Stunden</label>
                        <input type="number" class="form-control" id="time" name = "time">
                    </div>
                    <div class="form-group">
                        <label for="date">Datum</label>
                        <input type="date" class="form-control" id="date" name = "date">
                    </div>
                    <div class="form-group">
                        <label for="comment">Datum</label>
                        <input type="text" class="form-control" id="comment" name = "comment">
                    </div>
                    <input type="submit" class="btn btn-info" value="Buchen">
                </form>
            </div>';
    }
    echo $footer;
}