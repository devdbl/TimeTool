<?php
require_once("../controllers/ReportController.php");
require_once("../tools/DatabaseConnector.php");
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Bericht erstellen");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();
$showForm = true;

if(!isset($_SESSION['userid'])) {
    header("HTTP/1.1 404 Not Found");
    echo '<div class = "text"><a href="index.php">Startseite</a></div>';
    exit();
}else {

    echo $header;
    echo $navbar;
    echo $sidebar;

    if(isset($_GET['report'])) {
        $projectId = null;
        $userId = null;
        $dateArray['startDate'] = null;
        $dateArray['endDate'] = null;
        $showForm = false;

        if (isset($_POST['projectId'])) {
            $projectId = $_POST['projectId'];
        }
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];
        }
        if (isset($_POST['startDate'])) {
            $dateArray['startDate'] = $_POST['startDate'];
        }
        if (isset($_POST['endDate'])) {
            $dateArray['endDate'] = $_POST['endDate'];
        }

        $requestMethod = 'GET';

        $dbConnection = (new DatabaseConnector())->connect();

        $reportController = new ReportController($dbConnection, $requestMethod, $projectId, $userId, $dateArray);
        $reportController->processRequest();

        /*echo "<div class='inhalt'</div>";
        echo "<h1>Buchungsstatistik</h1>";
        echo "<h2>Total pro Mitarbeiter</h2>";
        echo "<table class='table table-bordered table-sm'>";
        echo "<thead><tr><th>Mitarbeiter</th><th>Projekte</th></tr></thead>";
        foreach($reportController->dataArray as $row){
            "<tr><td>".$row["Jahr"]."</td><td>".$row["Total"]."</td></tr>";
        }*/
    }

    if(isset($errorMessage)) {
        echo '<div class = "error"><mark>'.$errorMessage.'</mark></div>';
    }

    if($showForm) {
        echo '
            <div class="inhalt">
                <h1>Bericht erstellen</h1>
                <form action="?report" method="post">
                    <div class="form-group">
                        <label for="date1">Start Datum</label>
                        <input type="date" class="form-control" id="date1" name = "startDate">
                    </div>
                    <div class="form-group">
                        <label for="date2">End Datum</label>
                        <input type="date" class="form-control" id="date2" name = "endDate">
                    </div>
                    <input type="submit" class="btn btn-info" value="Bericht erstellen">
                </form>
            </div>';
    }
echo $footer;

}