<?php
require_once ("Helper.php");
$helper = new Helper();
$header = $helper->getHeader("Logout");
$navbar = $helper->getNavbar();
$footer = $helper->getFooter();

session_start();
session_destroy();

echo $header;
echo $navbar;
echo '<div class = "text">Logout erfolgreich</div>';
echo $footer;