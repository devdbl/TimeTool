<?php
require_once ("./views/Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("LandingPage");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();



echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class = "text">Bitte zuerst <a href="./views/login.php">einloggen</a></div>');
}else {
    echo $sidebar;
    echo '  <div class="inhalt">
                <h1>Herzlich Willkommen</h1>
                <p>'.$_SESSION['name'].'</p>
   
            </div>';
}
echo $footer;