<?php
session_start();
error_reporting(0);
require('db.php');
//include auth_session.php file on all user panel pages
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Forget Password</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<?php
    // When form submitted, insert values into the database.
    if (isset($_POST['fatherfname'])) {

        $fatherfname = stripslashes($_REQUEST['fatherfname']);    
        $fatherfname = mysqli_real_escape_string($con, $fatherfname);
        $motherfname = stripslashes($_REQUEST['motherfname']);
        $motherfname = mysqli_real_escape_string($con, $motherfname);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query  = "SELECT * FROM `users` WHERE fatherfname='$fatherfname'
        AND motherfname='$motherfname' and id='$userid' ";    
        
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
             $q="update users set password='".md5($password)."' where id='$userid'";
             $result1 = mysqli_query($con, $q);
             session_destroy();
             echo "<div class='form'>
             <h3>Password Reset successfully</h3><br/>
             <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
             </div>";
            // Redirect to user dashboard page
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Credentials</h3><br/>
                  <p class='link'>Click here to <a href='forgetpassword.php'>Try again</a> .</p>
                  </div>";
        }


    }  else {
        ?>
            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h1 class="login-title">Forgot Password Page</h1>
                <input type="text" class="login-input" name="fatherfname" placeholder="Father's first name" required />
                <input type="text" class="login-input" name="motherfname" placeholder="Mother's first name">
                <input type="password" class="login-input" name="password" placeholder="New Password">
                <input type="submit" name="submit" value="Reset" class="login-button">
                <p class="link">Go to <a href="login.php">Login Page</a></p>
            </form>
        <?php
            }
        ?>
        </body>
        </html>
        