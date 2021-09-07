<?php
require_once("../controllers/ProjectController.php");
require_once("../tools/DatabaseConnector.php");
require_once ("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Projekt anlegen");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();
$showForm = true;
$error = false;
$projectId = 1234; //muss noch automatisiert werden

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

if(isset($_GET['edit'])){

    $getDeactivatedProjects = null;
    $showForm = false;
    $requestMethod = 'PUT';

    if(strlen($_POST['projectname']) == 0) {
        echo '<div class="text"><mark>Bitte ein Projektnamen angeben</mark><br></div>';
        $error = true;
        $showForm = true;
    }
    if(!isset($_POST['isActive'])) {
        $_POST['isActive'] = "0";
    }
    if(!$error) {

        $dbConnection = (new DatabaseConnector())->connect();

        $projectController = new ProjectController($dbConnection, $requestMethod, $projectId, $getDeactivatedProjects);
        $projectController->processRequest();
    }
}




if($showForm) {
    echo '
          <div class="inhalt">
            <h1>Bitte erfasse deine Änderungen</h1>
            <h2>Projektnummer: '.$projectId.'</h2>
                <form action="?edit" method="post">
                    <div class="form-group">
                        <label for="projectName">Projektname:</label>
                        <input type="text" class="form-control" id="projectName" name="projectname">
                    </div>
                    <div class="form-group">
                        <label for="description">Beschreibung</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" value="1" class="custom-control-input" id="customCheck" name="isActive">
                        <label class="custom-control-label" for="customCheck">Projekt ist aktiv</label>
                    </div>
                    <input type="submit" class="btn btn-info" value="Projekt updaten">
                </form>';
}
echo $footer;
//}