<?php
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
session_start();
include("db.php");
$pagename="a smart buy for a smart home"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
//applied to the query string u_prod_id
//store the value in a local variable called $prodid
$prodid=$_GET['u_prod_id'];

//display the value of the product id, for debugging purposes
//echo "<p>Selected product Id: ".$prodid."</p>";
$SQL="select prodId, prodName, prodPicNameLarge, prodDescripLong, prodPrice, prodQuantity from Product where prodId=$prodid";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

echo "<table style='border: 0px'>";
$arrayp=mysqli_fetch_array($exeSQL);

    echo "<tr>";
    echo "<td style='border: 0px'>";
    //make the image into an anchor to prodbuy.php and pass the product id by URL (the id from the array)
    echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
//display the small image whose name is contained in the array
    echo "<img src=images/".$arrayp['prodPicNameLarge']." height=200 width=200>";
    //close the anchor
    echo "</a>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    echo "<p><h5>".$arrayp['prodName']."</h5></p>";
    echo "<p>".$arrayp['prodDescripLong']."</p>";
    echo "<p><b>".$arrayp['prodPrice']."</b></p>";
    echo "<p>"."Left in Stock: ";
    echo $arrayp['prodQuantity']."</p>";
    echo "</td>";
//display product name as contained in the array
    echo "</tr>";

echo "</table>";
echo "<br><p> Number to be purchased: ";
//create form made of one text field and one button for user to enter quantity
//the value entered in the form will be posted to the basket.php to be processed
echo "<form action='basket.php' method='post'>";
echo "<select name='p_quantity'>";
    for ($x = 1; $x <= $arrayp['prodQuantity']; $x++) {
        echo "<option value=".$x.">".$x."</option>";
    }
echo "</select>";
//echo "<input type='hidden' name='h_prodid' value=".$prodid.">";
echo "<input type='submit' name='submitbtn' value='ADD TO BASKET' id='submitbtn'>";
//pass the product id to the next page basket.php as a hidden value
echo "<input type='hidden' name='h_prodid' value=".$prodid.">";
echo "</form>";
echo "</p>";
include("footfile.html"); //include head layout echo "</body>";
?>