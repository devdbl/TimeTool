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
$html = null;

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}else {

    echo $sidebar;

    if(isset($_GET['report'])) {
        $projectId = null;
        $userId = null;
        $dateArray['startDate'] = null;
        $dateArray['endDate'] = null;
        $overview = 1;
        $requestMethod = 'WEB';
        $showForm = false;

        if (isset($_POST['projectId'])) {
            $projectId = $_POST['projectId'];
        }
        if (isset($_SESSION['userid'])) {
            $userId = $_SESSION['userid'];
        }
        if (isset($_POST['startDate'])) {
            $dateArray['startDate'] = $_POST['startDate'];
        }
        if (isset($_POST['endDate'])) {
            $dateArray['endDate'] = $_POST['endDate'];
        }

        $dbConnection = (new DatabaseConnector())->connect();

        $reportController = new ReportController($dbConnection, $requestMethod, $projectId, $userId, $dateArray, $overview);
        $reportController->processRequest();

        echo "<div class='inhalt'</div>";
        echo "<h1>Buchungsstatistik</h1>";
        echo "<h2>Total pro Mitarbeiter</h2>";
        echo "<table class='table table-bordered table-sm'>";
        echo "<thead><tr><th>Mitarbeiter</th><th>Projekt</th><th>Zeit</th></tr></thead>";
        $sum = 0;
        foreach($reportController->dataArray as $row){
            $html .= "<tr><td>".$row["EMPLOYEE_ID"]."</td><td>".$row["PROJECT_ID"]."</td><td>".$row["SUM(TIME)"]."</td></tr>";
            $sum++;
        }
        $html .= "<tfoot><tr><th>Summe</th><th>$sum</th></tr></tfoot></table>";
        echo $html;

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