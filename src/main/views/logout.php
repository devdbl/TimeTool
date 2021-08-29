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
echo '<div class = "text">Logout erfolgreich<br>
      <a href="index.php">Landing Page</a>
      </div>';
echo $footer;