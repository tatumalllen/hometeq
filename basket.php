<?php
include("db.php");
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
session_start();
$pagename="smart basket"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
include("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//if the value of the product id is to be deleted (which was posted through the hidden field) is set
if(isset($_POST['del_prodid']))
{
    //capture the posted product id and assign it to a local variable $delprodid
    $delprodid=$_POST['del_prodid'];
    //unset the cell of the session for this posted product id variable
    unset ($_SESSION['basket'][$delprodid]);
    //display a "1 item removed from the basket" message
    echo " <p class='updateInfo'><b>1 item removed</b></p>";
}
//if the posted ID of the new product is set i.e. if the user is adding a new product into the basket
if(isset($_POST['h_prodid'])){
    //Capture the ID of selected product using the POST Method and the $_POST superglobal variable
    //and store it in a new local variable called $newprodid
    $newprodid=$_POST['h_prodid'];
    echo "<p>Selected product Id: ".$newprodid."</p>";
    //capture the required quantity of selected product using the POST method and $_POST superglobal variable
    //and store it in a new local variable called $reququantity
    $reququantity=$_POST['p_quantity'];
    //echo "<p>Selected quantity: ".$reququantity."</p>";

    $_SESSION['basket'][$newprodid]=$reququantity;
    echo "<p><b>  1 item added</b></p>";
    //display id of selected product
    //display quantity of selected product

    //create a new cell in the basket session array. Index this cell with the new product id.
    //Inside the cell store the required product quantity

    //Display "1 item added to the basket" message
}
else{
    //Display "Basket unchanged" message
    echo "<p class='updateInfo'><b>  BASKET UNCHANGED   </b></p>";
}
//Create a variable $total and initialize it to zero
$total = 0;
//Create a HTML table with a header to display the content of the shopping basket
//i.e. the product name, the price, the selected quantity and the subtotal
echo "<p><table id='baskettable'><tr><th><b>Product Name</b></th><th><b>Price</b></th><th><b>Selected Quantity</b></th><th><b>Subtotal</b></th><th><b>Remove</b></th></tr>";
//if the session array $_SESSION['basket'] isset
if(isset($_SESSION['basket'])){
    //loop through the basket session array for each data item inside the session using a foreach loop
    //to split the session array between the index and the content of the cell
    //for each iteration of the loop
    //store the id in a local variable $index and store the required quantity into a local variable $value
    foreach($_SESSION['basket'] as $index => $value){
        //SQL query to retrieve from product table details of selected product for which id matches $index
        $SQL="select prodId, prodName, prodPrice from Product where prodId=".$index;
        //execute query and create array of records $arrayp
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
        $arrayp=mysqli_fetch_array($exeSQL);
        //create new HTML table row
        //display product name and price using $arrayp
        //display selected quantity from $value
        //calculate and display subtotal
        $subtotal = $arrayp['prodPrice']*$value;
        echo "<tr><td>".$arrayp['prodName']."</td><td>&pound".number_format($arrayp['prodPrice'],2)."</td><td style='text-align:center;'>".$value."</td><td>&pound".number_format($subtotal,2)."</td>";
        //add REMOVE Buttons
        echo "<form action='basket.php' method=post>";
        echo "<td>";
        echo "<input type='submit' value='Remove' id='submitbtn'>";
        echo "</td>";
        echo "<input type='hidden' name='del_prodid' value=".$arrayp['prodId'].">";
        echo "</form>";
        echo "</tr>";
        //increase total by adding to current total
        $total = $total+$subtotal;
    }
}
else{
    //Display empty basket message
    echo "<p class='updateInfo'><b>EMPTY BASKET</b></p>";
}
//display total
echo "<tr><td colspan=4><b>TOTAL:</b></td><td><b>&pound".number_format($total,2)."</b></td></tr></table>";
if(isset($_SESSION['basket']) and count($_SESSION['basket'])>0)
{
//Display an anchor to clear the basket
    echo "<p class='updateInfo'><a href='clearbasket.php'>CLEAR BASKET</a></p>";
//if the session user id $_SESSION['userid'] is set (i.e. if the user has logged in successfully)
    if(isset($_SESSION['userid'])) {
//display a Checkout anchor to link to checkout.php
        echo "<p class='updateInfo'><a href='checkout.php'>CHECKOUT</a></p>";
    }
    else
    {
//display a Signup anchor for new customers to link to signup.php
//display a Login anchor for returning customers to link to login.php
        echo "<p class='updateInfo'>New homteq customers: <a href='signup.php'>Sign Up!</a></p>";
        echo "<p class='updateInfo'>Returning homteq customers: <a href='login.php'>Log In!</a></p>";
    }
}
include("footfile.html"); //include head layout echo "</body>";
?>