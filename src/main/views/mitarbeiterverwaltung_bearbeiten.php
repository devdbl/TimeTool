<?php
require_once ("Helper.php");

session_start();

$helper = new Helper();
$header = $helper->getHeader("Mitarbeiter verwalten");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();
$footer = $helper->getFooter();

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}else {
    echo $sidebar;
    echo '
          <div class="inhalt">
            <h1>Bitte erfasse deine Änderungen</h1>
                <form>
                    <div class="form-group">
                        <label for="firstname">Vorname</label>
                        <input type="text" class="form-control" id="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nachname</label>
                        <input type="text" class="form-control" id="lastname">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Passwort</label>
                        <input type="text" class="form-control" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Passwort wiederholen</label>
                        <input type="text" class="form-control" id="pwd2">
                    </div>';
    if($_SESSION['admin'==1]){
        echo    '<div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                    <label class="custom-control-label" for="customCheck">Administrator</label>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                    <label class="custom-control-label" for="customCheck">Mitarbeiter deaktivieren</label>
                </div>';
    }
    echo    '<input type="submit" class="btn btn-info" value="Speichern">
            </form>';

    echo $footer;
}