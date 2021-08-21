<?php

require '../../vendor/autoload.php';
use Auth0\SDK\Auth0;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$auth0 = new Auth0([
    'domain' => $_ENV['AUTH0_DOMAIN'],
    'client_id' => $_ENV['AUTH0_CLIENT_ID'],
    'client_secret' => $_ENV['AUTH0_CLIENT_SECRET'],
    'redirect_uri' => $_ENV['AUTH0_CALLBACK_URL'],
    'scope' => 'openid profile email',
]);



$userInfo = $auth0->getUser();

if (!$userInfo) {
    echo '<a href="login.php">Log In</a>';
} else {
    echo '
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>LandingPage</title>
        <link rel="stylesheet" href="./views/css/app.css">

    </head>
    <body>
        <h1>Welcome to TimeTool</h1>
        </br>
        <a href="views/html/NewProjectForm.html">Neues Projekt</a> </br></br>
        <a href="views/html/EditProject.html">Edit Projekt</a> </br><br>
        <a href="views/html/User.html">Mitarbeiterverwalten</a> </br><br>

    </body>
</html>';
}
?>
<?php if(!$userInfo): ?>
    <a href="login.php">Log In</a>
<?php else: ?>
  <a href="/logout.php">Logout</a>
<?php endif ?>




