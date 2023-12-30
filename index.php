<?php
session_start();
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
$pagename="make your home smart"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
include("db.php");
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//display name of the page as window title
//include header layout file
//display name of the page on the web page
//display random text
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select prodId, prodName, prodPicNameSmall, prodDescripShort, prodPrice from Product";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
    echo "<tr>";
    echo "<td style='border: 0px'>";
    //make the image into an anchor to prodbuy.php and pass the product id by URL (the id from the array)
    echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
//display the small image whose name is contained in the array
    echo "<img src=images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
    //close the anchor
    echo "</a>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    echo "<p><h5>".$arrayp['prodName']."</h5></p>";
    echo "<p>".$arrayp['prodDescripShort']."</p>";
    echo "<p><b>".$arrayp['prodPrice']."</b></p>";
    echo "</td>";
//display product name as contained in the array
    echo "</tr>";
}
echo "</table>";
include("footfile.html"); //include head layout echo "</body>";
?>