<?php
require_once("../controllers/EmployeeController.php");
require_once("../tools/DatabaseConnector.php");
require_once ("Helper.php");

session_start();

$script = ' <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
            <script src="JS/getEmployees.js"></script>';

$helper = new Helper();
$header = $helper->getHeader("Mitarbeiter verwalten", $script);
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

    if(isset($_GET['edit'])){
        $userId = $_SESSION['userid'];
        $showForm = false;
        $requestMethod = 'PUT';

        if(isset($_POST['personalId'])){
            $userId = $_POST['personalId'];
        }

        if(strlen($_POST['password1']) == 0) {
            echo 'Bitte ein Passwort angeben<br>';
            $error = true;
        }
        if($_POST['password1'] != $_POST['password2']) {
            echo 'Die Passwörter müssen übereinstimmen<br>';
            $error = true;
        }

        if(!$error) {
            $_POST['password'] = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $_POST['password1'] = null;
            $_POST['password2'] = null;
            $dbConnection = (new DatabaseConnector())->connect();

            $employeeController = new EmployeeController($dbConnection, $requestMethod, $userId);
            $employeeController->processRequest();
        }
    }

    if ($_SESSION['admin'] == 1) {
        echo '  <div class="inhalt">
                <button id="showEmployee" class="btn btn-info">Mitarbeiter anzeigen</button>
                <br><br>
                <h3>Mitarbeiter</h3>
                <ol id="employeeList"></ol>       
                
                <br><br>
                </div>';
    }


    if($showForm) {
        echo '
          <div class="inhalt">
            <h1>Bitte erfasse deine Änderungen</h1>
                <form action="?edit" method="post">
                    <div class="form-group">
                        <label for="firstname">Vorname</label>
                        <input type="text" class="form-control" id="firstname" required maxlength="20" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nachname</label>
                        <input type="text" class="form-control" id="lastname" required maxlength="20" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Passwort</label>
                        <input type="password" class="form-control" id="pwd" required name="password1">
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Passwort wiederholen</label>
                        <input type="password" class="form-control" id="pwd2" name="password2">
                    </div>';
        if ($_SESSION['admin'] == 1) {
            echo '
                <div class="form-group">
                    <label for="id">Mitarbeiter ID</label>
                    <input type="number" class="form-control" id="id" required name="personalId">
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="role">
                    <label class="custom-control-label" for="customCheck">Administrator</label>
                </div>';
        }
        echo '<input type="submit" class="btn btn-info" value="Speichern">
            </form>';
    }
    echo $footer;
}