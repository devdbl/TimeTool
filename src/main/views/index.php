<?php
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("LandingPage");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar($_SESSION['admin']);
$footer = $helper->getFooter();



echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class = "text">Bitte zuerst <a href="login.php">einloggen</a> oder 
                                          <a href="register.php">registrieren</a></div>');
}elseif($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    setcookie(session_name(),"invalid",0,"/");
}else{
    echo $sidebar;
    echo '  <div class="inhalt">
            <h1>Herzlich Willkommen</h1>
            <h2>' . $_SESSION['name'] . '</h2>

        </div>';

}
echo $footer;