<?php
require_once("./tools/DatabaseConnector.php");

session_start();
$db = (new DatabaseConnector())->connect();

if(isset($_GET['login'])) {
    $shortname = $_POST['shortname'];
    $passwort = $_POST['password'];

    $statement = $db->prepare("SELECT * FROM employee WHERE SHORTNAME = :shortname");
    $result = $statement->execute(array('shortname' => $shortname));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['PASSWORD'])) {
        $_SESSION['userid'] = $user['EMPLOYEE_ID'];
        $_SESSION['isAdmin']= $user['ROLE'];
        die('Login erfolgreich. Weiter zu <a href="index.php">internen Bereich</a>');
    } else {
        $errorMessage = "Kürzel oder Passwort war ungültig<br>";
    }

}
?>
    <!DOCTYPE html>
    <html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="./views/css/app.css">
</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<form action="?login=1" method="post">
    E-Mail:<br>
    <input type="test" size="40" maxlength="250" name="shortname"><br><br>

    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="password"><br>

    <input type="submit" value="Abschicken">
</form>
</body>
    </html>
