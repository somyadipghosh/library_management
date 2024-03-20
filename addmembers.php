<?php
    session_start();
    error_reporting(0);
    require('db.php');
    include('auth_session.php');
    $msg=" ";
    if (isset($_POST['submit'])) {
        $membername = stripslashes($_REQUEST['membername']); 
        $membername = mysqli_real_escape_string($con, $membername);
        $phoneno = stripslashes($_REQUEST['phoneno']);
        $phoneno = mysqli_real_escape_string($con, $phoneno);
        $query="insert into members (membername,phoneno) values ('$membername','$phoneno')";
        $result = mysqli_query($con, $query);
        $msg="Member succesfully added.";
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Add members</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<form class="form" method="post" action="<?php echo $_server["PHP_SELF"]; ?>">
        <h1 class="login-title">Add a member</h1>
        <input type="text" class="login-input" name="membername" placeholder="Member's Name" autofocus="true" required/>
        <input type="text" class="login-input" name="phoneno" placeholder="Phone Number" required/>
        <input type="submit" value="Add" name="submit" class="login-button"/>
        <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <a href="allmembers.php" ><input type="button" value="Show all members"/></a>
        <?php 
        echo $msg; 
        ?>
  </form>

</body>
</html> 