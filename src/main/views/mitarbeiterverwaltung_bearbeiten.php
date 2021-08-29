<?php
require_once ("Helper.php");
$helper = new Helper();
$header = $helper->getHeader("Mitarbeiter verwalten");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar();

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}else {
    echo $sidebar;
    echo '<form>
            <div class="inhalt">
                <h1>Bitte erfassen sie einen neuen Mitarbeiter</h4><p></p>
                    <div class="form-group">
                        <label for="usr">Vorname</label>
                        <input type="text" class="form-control" id="usr">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Nachname</label>
                        <input type="text" class="form-control" id="pwd">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Mitarbeiter ID</label>
                        <input type="text" class="form-control" id="pwd">
                      </div>
                      <div class="form-group">
                        <label for="pwd">E-Mail</label>
                        <input type="text" class="form-control" id="pwd">
                      </div>
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                        <label class="custom-control-label" for="customCheck">Mitarbeiter Aktiv</label>
                      </div>
                      <input type="submit" class="btn btn-info" value="Speichern">
                </form>';

    echo $helper->getFooter();
}