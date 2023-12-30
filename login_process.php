<?php
session_start();
include("db.php");
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css' />";
$pagename="login results"; //Create and populate a variable called $pagename echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
//Capture the 2 inputs entered in the form (email and password) using the $_POST superglobal variable
$email = $_POST['l_email'];
$password = $_POST['l_password'];
////Assign these values to 2 new local variables $email and $password
//Display the content of these 2 variables to ensure that the values have been posted properly
echo "<p class='updateInfo'>Login email: ".$email."</p>";
echo "<p class='updateInfo'>Login pwd: ".$password."</p>";
if(empty($email) or empty($password))
{
    echo "<p class='updateInfo'><b>Login failed!</b></p>"; //display login error
}
else
{
    //SQL query to retrieve the record from the users table for which the email matches login email (in form)
    $SQL = "SELECT * FROM Users WHERE userEmail = '".$email."'";
    //execute the SQL query & fetch results of the execution of the SQL query and store them in $arrayu
    $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($con));
    //also capture the number of records retrieved by the SQL query using function mysqli_num_rows and store it
    $nbrecs = mysqli_num_rows($exeSQL);
    //in a variable called $nbrecs
    //if the number of records is 0 (i.e. email retrieved from the DB does not match $email login email in form
    if($nbrecs == 0) // if nbrecs is 0 (or not located)
    {
        //display error message "Email not recognised, login again"
        echo "<p class='updateInfo'><b>No User Found; Email Not Recognized</b></p>";
        echo "<p class='updateInfo'>Go back to <a href=login.php>login</a></p>";
    }
    else
    {
        //create array for user of email
        $arrayu = mysqli_fetch_array($exeSQL);
        //if password retrieved from the database (in arrayu) does not match $password
        if($arrayu['userPassword'] <> $password)//if password matches
        {
             //display error message "Password not recognised, login again"
            echo "<p class='updateInfo'><b>Password not recognized, login again!</b></p>";
            echo "<p class='updateInfo'>Go back to <a href=login.php>login</a></p>";
        }
        else
        {
            //display login success message and store user id, user type, name into 4 session variables i.e.
            echo "<p class='updateInfo'><b>Login success!</b></p>";
            //create $_SESSION['userid'], $_SESSION['usertype'], $_SESSION['fname'], $_SESSION['sname'],
            $_SESSION['userid'] = $arrayu['userId'];
            $_SESSION['fname'] = $arrayu['userFName'];
            $_SESSION['sname'] = $arrayu['userSName'];
            $_SESSION['usertype'] = $arrayu['userType'];
            //Greet the user by displaying their name using $_SESSION['fname'] and $_SESSION['sname']
            if($_SESSION['usertype'] == 'C') // if user is type c they are a customer
            {
                echo "<p class='updateInfo'><b>User Type: homteq customer</b></p>";
            }
            if($_SESSION['usertype'] == 'A') //if user is type a they are admin
                {
                    echo "<p class='updateInfo'><b>User Type: homteq admin</b></p>";
                }

            //Welcome them as a customer by using $_SESSION['usertype ']
            echo "<p class='updateInfo'>Continue shopping for <a href=index.php>Home Tech</a></p>";
            echo "<p class='updateInfo'>View Your <a href=basket.php>Basket</a></p>";
        }
    }
}
include("footfile.html"); //include head layout echo "</body>";
?>