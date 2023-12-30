<?php
session_start();
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
$pagename="logout"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//Display thank you message
echo "<p class='updateInfo'> Thank you, ".$_SESSION['fname']." ".$_SESSION['sname']."</p>";
//unset the session
unset($_SESSION);
//destroy the session
session_destroy();
//Display a log out confirmation message
echo "<p class='updateInfo'>You are now logged out</p>";
include("footfile.html"); //include head layout echo "</body>";
?>