<?php
require_once("../tools/DatabaseConnector.php");
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Projekt Mutation");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}else {

    echo $sidebar;

    echo '<div class="inhalt">';
    echo '<h1>Was möchten sie tun?</h1>';
    echo '<br><br>';
    echo '<div class="form-group">';
    echo '<a href="projektverwaltung_neu.php" class="btn btn-outline-dark" role="button">Projekt erfassen</a>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<a href="projektverwaltung_bearbeiten.php" class="btn btn-outline-dark" role="button">Projekt Daten ändern</a>';
    echo '</div>';
    echo '</div>';
    
    echo $footer;
}