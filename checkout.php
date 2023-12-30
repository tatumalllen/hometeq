<?php
session_start();
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
include("db.php");
mysqli_report(MYSQLI_REPORT_OFF);
$pagename="checkout"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//store the current date and time in a local variable $currentdatetime
//use the date PHP function with the 'Y-m-d H:i:s' parameters to make it compatible with the MySQL format.
$currentdatetime = date('Y-m-d H:i:s');
$SQL = "insert into Orders (userId, orderDateTime, orderStatus, shippingDate) values('".$_SESSION['userid']."', '".$currentdatetime."', 'Placed', '".$currentdatetime."')";
if (mysqli_query($conn, $SQL) and isset($_SESSION['basket']) and count($_SESSION['basket'])>0)//execution of SQL query to add new order correct and session basket is set and nb of elements in session is > 0
{
//Display "order success" message
echo "<p class='updateInfo'> Order Success </p>";
//SQL SELECT query to retrieve max order number for current user (for which id matches the id in the session)
    $maxNo= "select max(orderNo) as orderNo from Orders where userId = ".$_SESSION['userid'];
//to retrieve the order number of most recent order placed by current user i.e. the order just created
//execute SELECT SQL query
//fetch the result of the execution of the SQL statement and store it in an array arrayo
    $exeMaxSQL=mysqli_query($conn, $maxNo) or die (mysqli_error($conn));
    $arrayo=mysqli_fetch_array($exeMaxSQL);
//store the value of this order number in a local variable and display the order number.
    $orderno = $arrayo['orderNo'];
    echo "<p class='updateInfo'>Order Number: ".$orderno."</p>";
//as for basket.php, display a table header for product name, price, quantity and subtotal
    echo "<p><table id='baskettable'><tr><th><b>Product Name</b></th><th><b>Price</b></th><th><b>Selected Quantity</b></th><th><b>Subtotal</b></th></tr>";

//as for basket.php, FOREACH loop through basket session array & split value from index for every cell
    $total = 0;
    foreach($_SESSION['basket'] as $index => $value)
    {
//SQL query to retrieve product id, name and price from product table for every index in FOREACH loop
        $SQL2="select prodId, prodName, prodPrice from Product where prodId=".$index;
//execute SQL query, fetch the records and store them in an array of records $arrayb.
        $exeSQL2 = mysqli_query($conn, $SQL2);
        $arrayb=mysqli_fetch_array($exeSQL2);
//Calculate subtotal
        $subtotal = $arrayb['prodPrice']*$value;
//Note: these 3 instructions are the same as in basket.php
//SQL INSERT query to store details of ordered items in Order_line table in the DB i.e. order number,
//product id (index), ordered quantity (content of the session array) and subtotal. Execute INSERT query.
        $SQL3 = "insert into Order_Line (orderNo, prodId, quantityOrdered, subtotal) values(".$orderno.",".$index.",".$value.",".$subtotal.")";
        $exeSQL3=mysqli_query($conn, $SQL3);
//display the product name, price, ordered quantity and subtotal (same as for basket.php)
        echo "<tr><td>".$arrayb['prodName']."</td>
            <td>&pound".number_format($arrayb['prodPrice'],2)."</td>
            <td style='text-align:center;'>".$value."</td>
            <td>&pound".number_format($subtotal,2)."</td></tr>";
//increment total (same as for basket.php)
        $total = $total + $subtotal;
    }
//create a new table row to display the total (same as for basket.php)
    echo "<tr><td colspan=3><b>TOTAL:</b></td><td><b>&pound".number_format($total,2)."</b></td></tr></table>";
//SQL UPDATE query to update the total value in the Orders table for this specific order
    $SQL4 = "update Orders set orderTotal=".$total."";
//execute UPDATE SQL query.
    $exeSQL4 = mysqli_query($conn, $SQL4) or die (mysqli_error($conn));
}
else
{
//Display "order error" message
    echo "<p class='updateInfo'> Order Error </p>";
}
//Unset the basket session array
unset($_SESSION['basket']);
include("footfile.html"); //include head layout echo "</body>";
?>