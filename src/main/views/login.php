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
        $_SESSION['name']   = $user['FIRSTNAME'];
        $_SESSION['isAdmin']= $user['ROLE'];
        die('Login erfolgreich. Weiter zu <a href="index.php">internen Bereich</a>'
            /*header('Location: https://localhost/index.php')*/);
    } else {
        $errorMessage = "Kürzel oder Passwort war ungültig<br>";
    }

}

echo $header;
echo $navbar;

if(isset($errorMessage)) {
    echo '<div class = "error"><mark>'.$errorMessage.'</mark></div>';
}

echo    '
        <div class="inhalt">
            <h1>Login</h1>
            <form action="?login=1" method="post">
                <div class="form-group">
                    <label for="id">Benutzername</label>
                    <input type="test" class="form-control" id="id" name = "shortname">
                </div>
                <div class="form-group">
                    <label for="pwd">Passwort</label>
                    <input type="password" class="form-control" id="pwd" name = "password">
                </div>
                <input type="submit" class="btn btn-info" value="Login">
            </form>
        </div>';
