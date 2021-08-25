<?php
require_once("./tools/DatabaseConnector.php");

session_start();
$db = (new DatabaseConnector())->connect();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
    <link rel="stylesheet" href="./views/css/app.css">
</head>
<body>

<?php
$showForm = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $personalId = $_POST['personalId'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(!is_numeric($personalId)) {
        echo 'Bitte eine gültige Personalnummer eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
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
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO employee (EMPLOYEE_ID, FIRSTNAME, LASTNAME, PASSWORD) VALUES (:personalId, :firstname, :lastname, :passwort)");
        $result = $statement->execute(array(
                'personalId' => $personalId,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'passwort' => $passwort_hash));

        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showForm = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showForm) {
    ?>

    <form action="?register=1" method="post">
        Vorname:<br>
        <input type="text" size="40"  maxlength="250" name="firstname"><br>

        Nachname<br>
        <input type="text" size="40"  maxlength="250" name="lastname"><br>

        Personalnummer:<br>
        <input type="number" size="4" maxlength="4" name="personalId"><br><br>

        Dein Passwort:<br>
        <input type="password" size="40"  maxlength="250" name="passwort"><br>

        Passwort wiederholen:<br>
        <input type="password" size="40" maxlength="250" name="passwort2"><br><br>

        <input type="submit" value="Abschicken">
    </form>

    <?php
} //Ende von if($showFormular)
?>

</body>
</html>