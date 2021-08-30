<?php
require_once("../controllers/ReportController.php");
require_once("../tools/DatabaseConnector.php");
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Mutation");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();

if(!isset($_SESSION['userid'])) {
    header("HTTP/1.1 404 Not Found");
    echo '<div class = "text"><a href="index.php">Startseite</a></div>';
    exit();
}elseif($_SESSION['admin']==0) {
    die(header("Location: http://localhost/mitarbeiterverwaltung_bearbeiten.php"));

}else {

    echo $header;
    echo $navbar;
    echo $sidebar;

    echo '<div class="inhalt">';
    echo '<h1>Was möchten sie tun?</h1>';
    echo '<form>';
    echo '<a href="mitarbeiterverwaltung_bearbeiten.php" class="btn btn-outline-dark" role="button">Meine Daten ändern</a>';
    echo '<a href="mitarbeiterverwaltung_neu.php" class="btn btn-outline-dark" role="button">Mitarbeiter Daten ändern</a>';
    echo '</div>';
    echo $footer;
}







