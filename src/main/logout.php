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

echo '
    <!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>LandingPage</title>
        <link rel="stylesheet" href="./views/css/app.css">

    </head>
    <body>';

echo '<b>bye-bye</b><br>';
echo '<b>'.$userInfo['email'].'</b>';
echo '<a href="index.php">LandingPage</a>';

echo '</body>
</html>';
$auth0->logout();