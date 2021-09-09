<?php
require_once("../controllers/ProjectController.php");
require_once("../tools/DatabaseConnector.php");
require_once ("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Projekt anlegen");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar($_SESSION['admin']);
$footer = $helper->getFooter();
$showForm = true;
$error = false;

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

    if(isset($_GET['add'])){
        $projectId = null;
        $getDeactivatedProjects = null;
        $showForm = false;
        $requestMethod = 'POST';


        if (isset($_POST['projectId'])) {
            $projectId = $_POST['projectId'];
        }
        if(!is_numeric($projectId)) {
            echo '<div class="text"><mark>Bitte eine gültige Projektnummer eingeben</mark><br></div>';
            $error = true;
            $showForm = true;
        }
        if(strlen($_POST['projectname']) == 0) {
            echo '<div class="text"><mark>Bitte ein Projektnamen angeben</mark><br></div>';
            $error = true;
            $showForm = true;
        }
        if(!$error) {

            $dbConnection = (new DatabaseConnector())->connect();

            $projectController = new ProjectController($dbConnection, $requestMethod, $projectId, $getDeactivatedProjects);
            $projectController->processRequest();

            echo '<div class="text">Projekt erstellt<br></div>';
        }
    }




    if($showForm) {
        echo '
          <div class="inhalt">
            <h1>Bitte erfasse deine Änderungen</h1>
                <form action="?add" method="post">
                    <div class="form-group">
                        <label for="projectName">Projektname:</label>
                        <input type="text" class="form-control" id="projectName" required maxlength="20" name="projectname">
                    </div>
                    <div class="form-group">
                        <label for="projectId">Projekt Nummer:</label>
                        <input type="number" class="form-control" id="projectId" required name="projectId">
                    </div>
                    <div class="form-group">
                        <label for="description">Beschreibung</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <input type="submit" class="btn btn-info" value="Projekt erfassen">
                </form>';
    }
    echo $footer;
}