<?php
require_once("../tools/DatabaseConnector.php");
require_once ("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Login");
$navbar = $helper->getNavbar();
$footer = $helper->getFooter();

$db = (new DatabaseConnector())->connect();

echo $header;
echo $navbar;

$showForm = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $personalId = $_POST['personalId'];
    $shortname = $_POST['shortname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if(!is_numeric($personalId)) {
        echo 'Bitte eine gültige Personalnummer eingeben<br>';
        $error = true;
    }
    if(strlen($password) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($password != $password2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    if(!$error) {
        $statement = $db->prepare("SELECT * FROM employee WHERE EMPLOYEE_ID = :personalId");
        $result = $statement->execute(array('personalId' => $personalId));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese Personalnummer ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO employee (EMPLOYEE_ID, FIRSTNAME, LASTNAME, SHORTNAME, PASSWORD) VALUES (:personalId, :firstname, :lastname, :shortname, :password)");
        $result = $statement->execute(array(
                'personalId' => $personalId,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'shortname' => $shortname,
                'password' => $password_hash));

        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showForm = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showForm) {
echo
'<div class="inhalt">
    <h1>Anmeldung beim TimeTool</h1>
    <form action="?register=1" method="post">
        <div class="form-group">
            <label for="fistname">Vorname</label>
            <input type="text" class="form-control" id="fistname" required maxlength="45" name="firstname">
        </div>
        <div class="form-group">
            <label for="lastname">Nachname</label>
            <input type="text" class="form-control" id="lastname" required maxlength="45" name="lastname">
        </div>
        <div class="form-group">
            <label for="id">Mitarbeiter ID</label>
            <input type="number" class="form-control" id="id" required name="personalId">
        </div>
        <div class="form-group">
            <label for="shortname">Benutzername</label>
            <input type="text" class="form-control" id="shortname" required maxlength="4" name="shortname">
        </div>
        <div class="form-group">
            <label for="pwd">Passwort</label>
            <input type="password" class="form-control" id="pwd" required name="password">
        </div>
        <div class="form-group">
            <label for="pwd2">Passwort wiederholen</label>
            <input type="password" class="form-control" id="pwd2" required name="password2">
        </div>
        <input type="submit" class="btn btn-info" value="Anmeldung abschliessen">
    </form>
</div> ';

}
echo $footer;