<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");
$userid=$_SESSION['userid'];

$query="select * from users where id='$userid'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    $msg="";
    if (isset($_POST['submit'])) {
       
        $oldpassword = stripslashes($_REQUEST['oldpassword']);
        $oldpassword = md5(mysqli_real_escape_string($con, $oldpassword));
        $newpassword = stripslashes($_REQUEST['newpassword']);
        $newpassword = mysqli_real_escape_string($con, $newpassword);

        if($oldpassword==$row['password']){
         $q="update users set password='".md5($newpassword)."' where id='$userid'";
         $result1 = mysqli_query($con, $q);
         
         echo "<div class='form'>
                  <h3>password changed sucessfully.</h3>
                  <br>
                  <a href='dashboard.php' ><input type='button' value='Home'/></a>
                  </div>";
         
        } else {
            echo "<div class='form'>
                  <h3>Incorrect password.</h3>
                  <br>
                  <a href='dashboard.php' ><input type='button' value='Home'/></a>
                  </div>";
        }


    } else {
?>
    <form class="form" method="post" name="login" action="<?php echo $_server["PHP_SELF"]; ?>">
        <h1 class="login-title">Change Password</h1>
        <input type="password" class="login-input" name="oldpassword" placeholder="Old Password"/>
        <input type="password" class="login-input" name="newpassword" placeholder="New Password"/>
        <input type="submit" value="Change" name="submit" class="login-button"/>
        <?php 
         echo $msg;
        ?>
  </form>
<?php
    }
?>
</body>
</html>