<?php
session_start();
error_reporting(0);
include ('db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<script type="text/javascript">
$(document).ready(function(){

    $('#fpwd').click(function(){
        $('#fusername').show();
        $('#pbtn').show();
    })


})

</script>


<?php
    
    // When form submitted, check and create user session.
    if (isset($_POST['submit'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die (mysqli_error($con));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $row=mysqli_fetch_assoc($result);
            $_SESSION['password']=$password;
            $_SESSION['userid']=$row['id'];
            $_SESSION['fatherfname']=$row['fatherfname'];
            $_SESSION['motherfname']=$row['motherfname'];
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else  if (isset($_POST['fsubmit'])) {
        $fusername = stripslashes($_REQUEST['fusername']);
        $fusername = mysqli_real_escape_string($con, $fusername);
        $query1   = "SELECT * FROM `users` WHERE username='$fusername'";
        $result1 = mysqli_query($con, $query1);
        $rows1 = mysqli_num_rows($result1);
        if ($rows1 == 1) {
            $_SESSION['username'] = $fusername;
            $row1=mysqli_fetch_assoc($result1);

            $_SESSION['userid']=$row1['id'];
            // Redirect to user dashboard page
            header("Location: forgetpassword.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }

    } 

    
    else 
    
    {
?>
    <form class="form" action="<?php echo $_server["PHP_SELF"]; ?>" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
        <p class="link">Fotgot Password? <a id="fpwd" style="cursor: pointer;">Click here</a></p>
        <input type="text" class="login-input" id="fusername" name="fusername" style="display:none;" placeholder="Enter Username" autofocus="true"/>
        <input type="submit" value="Reset Password" id="pbtn" name="fsubmit" class="login-button" style="display:none;"/> 
  </form>
   

<?php
    }
?>
</body>
</html>
