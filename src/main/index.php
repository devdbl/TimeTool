<?php
session_start();
?>
<html>
    <head>
    <meta charset="UTF-8">
        <title>LandingPage</title>
        <link rel="stylesheet" href="./views/css/app.css">

    </head>
<?php
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}else {
    echo '
    <body>
        <h1>Welcome to TimeTool</h1>
        </br>
        <a href="views/html/NewProjectForm.html">Neues Projekt</a> </br></br>
        <a href="views/html/EditProject.html">Edit Projekt</a> </br><br>
        <a href="views/html/User.html">Mitarbeiterverwalten</a> </br><br><br><br><br><br><br><br>
        <a href="logout.php">Ausloggen</a> </br><br>

    </body>
</html>';
}