<?php
require_once("../tools/DatabaseConnector.php");
require_once("Helper.php");

session_start();

$script = ' <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
            <script src="JS/getProject.js"></script>';

$helper = new Helper();
$header = $helper->getHeader("Projekt auswahl");
$navbar = $helper->getNavbar();
$sidebar = $helper->getSidebar($_SESSION['admin']);
$footer = $helper->getFooter();

echo $header;
echo $navbar;

if(!isset($_SESSION['userid'])) {
    die('<div class="inhalt">Bitte zuerst <a href="login.php">einloggen</a></div>');
}elseif($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    setcookie(session_name(),"invalid",0,"/");
}else {

    echo $sidebar;

    echo '
          <div class="inhalt">
            <h1>Projekt auswälen</h1>  
            <br>         
            <button id="showProject" class="btn btn-info">Projekte anzeigen</button>
            <br><br>
            <h3>Projekte</h3>
            <ol id="projectList"></ol>       
            
            <br><br>
                 
            <form action="?get" method="get">
                <div class="form-group">
                    <label for="projectId">Projektnummer:</label>
                    <input type="text" class="form-control" id="projectId" required name="projectId">
                </div>
                <input type="submit" class="btn btn-info" value="Projekt auswählen">
            </form>';
}
echo $footer;
