<?php
require_once("../tools/DatabaseConnector.php");
require_once("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Mutation");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar($_SESSION['admin']);
$footer = $helper->getFooter();

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}elseif($_SESSION['admin']==0) {
    die(header("Location: http://localhost/mitarbeiterverwaltung_bearbeiten.php"));

}elseif($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    setcookie(session_name(),"invalid",0,"/");
}else {

    echo $sidebar;

    echo '<div class="inhalt">';
    echo '<h1>Was möchten sie tun?</h1>';
    echo '<br><br>';
    echo '<div class="form-group">';
    echo '<a href="mitarbeiterverwaltung_bearbeite.php" class="btn btn-outline-dark" role="button">Meine Daten ändern</a>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<a href="mitarbeiterverwaltung_bearbeiten.php" class="btn btn-outline-dark" role="button">Mitarbeiter Daten ändern</a>';
    echo '</div>';
    echo '</div>';
    echo $footer;
}







