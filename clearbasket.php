<?php
session_start();
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
session_start();
include("db.php");
$pagename="Clear Smart Basket"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";
unset($_SESSION['basket']);
echo "<p class='updateInfo'><b>Your basket has been cleared!</b></p>";
include("footfile.html");
echo "</body>";
?>