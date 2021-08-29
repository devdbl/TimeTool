<?php
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("LandingPage");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebarLandingPage();
$footer = $helper->getFooter();



echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class = "text">Bitte zuerst <a href="login.php">einloggen</a> oder 
                                          <a href="register.php">registrieren</a></div>');
}else {
    echo $sidebar;
    echo '  <div class="inhalt">
                <h1>Herzlich Willkommen</h1>
                <p>'.$_SESSION['name'].'</p>
   
            </div>';
}
echo $footer;