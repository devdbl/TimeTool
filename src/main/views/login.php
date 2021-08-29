<?php
require_once("../tools/DatabaseConnector.php");
require_once ("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Login");
$navbar = $helper->getNavbar();


$db = (new DatabaseConnector())->connect();

if(isset($_GET['login'])) {
    $shortname = $_POST['shortname'];
    $password = $_POST['password'];

    $statement = $db->prepare("SELECT * FROM employee WHERE SHORTNAME = :shortname");
    $result = $statement->execute(array('shortname' => $shortname));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['PASSWORD'])) {
        $_SESSION['userid'] = $user['EMPLOYEE_ID'];
        $_SESSION['isAdmin']= $user['ROLE'];
        die('Login erfolgreich. Weiter zu <a href="../index.php">internen Bereich</a>');
    } else {
        $errorMessage = "Kürzel oder Passwort war ungültig<br>";
    }

}

if(isset($errorMessage)) {
    echo $errorMessage;
}
echo $header;
echo $navbar;
echo    '<form>
            <div class="inhalt">
                <h1>Login</h1><p></p>
                    <div class="form-group">
                        <label for="shortname">Benutzername</label>
                        <input type="text" class="form-control" id="shortname">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Passwort</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <input type="submit" class="btn btn-info" value="Login">
        </form>';
