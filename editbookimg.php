<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");
$msg="";
if (isset($_POST['submit'])) {
    $sno = stripslashes($_GET['sno']); 
    $sno = mysqli_real_escape_string($con, $sno);
    $target_dir = "bookimg/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;

    
      if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
        $uploadOk = 0;
        }

if ($uploadOk == 1){
$query="update bookinfo set img='$target_file' where sno='$sno'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

$msg="Book succesfully edited.";
}


}else {
    $sno = stripslashes($_GET['sno']); 
    $sno = mysqli_real_escape_string($con, $sno);
    $query="select * from bookinfo where sno='$sno'";
    $result = mysqli_query($con, $query);
    $row=mysqli_fetch_assoc($result);
    
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
        <h1 class="login-title">Edit book image</h1>
        <img src="<?php echo $row['img'];?>" width="60" >
        <input type="file" class="login-input" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Edit" name="submit" class="login-button"/>
        <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <a href="allbooks.php" ><input type="button" value="Show all Books"/></a>
        <?php 
        echo $msg; 
        ?>
  </form>

</body>
</html> 