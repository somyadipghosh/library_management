<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");
$msg="";

function checkcatagory($cat,$str){
    if (strpos($cat,$str)!==false){
        return 'checked="checked"';
    } 
}

if (isset($_POST['submit'])) {
    $sno = stripslashes($_GET['sno']); 
    $sno = mysqli_real_escape_string($con, $sno);
    $bookname = stripslashes($_POST['bookname']); 
    $bookname = mysqli_real_escape_string($con, $bookname);
    $authorname = stripslashes($_POST['authorname']);
    $authorname = mysqli_real_escape_string($con, $authorname);
    $price = stripslashes($_POST['price']);
    $price = mysqli_real_escape_string($con, $price);
    $catagory='';
        if(!empty($_POST['catagory'])) {
            foreach($_POST['catagory'] as $check) {
                    $catagory.=','.$check; 
            }
        }
   

    
    $query="update bookinfo set bookname='$bookname',authorname='$authorname',price='$price',catagory='$catagory' where sno='$sno'";
    $result = mysqli_query($con, $query);
    $row=mysqli_fetch_array($result);
    $msg="Book succesfully edited.";


} else {
    $sno = stripslashes($_GET['sno']); 
    $sno = mysqli_real_escape_string($con, $sno);
    $query="select * from bookinfo where sno='$sno'";
    $result = mysqli_query($con, $query);
    $row=mysqli_fetch_assoc($result);
    $cat=$row['catagory'];

    
   
   
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<form class="form" method="post" action="<?php echo $_server["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <h1 class="login-title">Edit a Book</h1>
        <input type="text" class="login-input" name="bookname"  autofocus="true" value="<?php echo $row['bookname']; ?>" />
        <div style="height: 100px;" class="login-input">
        <input type="checkbox"  name="catagory[]" value="Adventure" <?php echo checkcatagory($cat,'Adventure'); ?> >
        <label for="vehicle1"> Adventure</label><br>
        <input type="checkbox"  name="catagory[]" value="Fiction" <?php echo checkcatagory($cat,'Fiction'); ?> >
        <label for="vehicle2"> Fiction</label><br>
        <input type="checkbox"  name="catagory[]" value="Thriller" <?php echo checkcatagory($cat,'Thriller'); ?>>
        <label for="vehicle3"> Thriller</label><br>
        <input type="checkbox"  name="catagory[]" value="Biography" <?php echo checkcatagory($cat,'Biography'); ?>>
        <label for="vehicle3"> Biography</label><br>
        <input type="checkbox"  name="catagory[]" value="Romance" <?php echo checkcatagory($cat,'Romance'); ?>>
        <label for="vehicle3"> Romance</label><br><br>
        </div>
        <input type="text" class="login-input" name="authorname" value="<?php echo $row['authorname']; ?>" />
        <input type="text" class="login-input" name="price" value="<?php echo $row['price']; ?>" />
        <input type="submit" value="Edit" name="submit" class="login-button"/>
        <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <a href="allbooks.php" ><input type="button" value="Show all Books"/></a>
        <?php 
        echo $msg; 
        ?>
  </form>

</body>
</html> 