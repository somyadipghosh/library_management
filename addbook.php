<?php
    include('auth_session.php');
    error_reporting(0);
    require('db.php');
    
    $msg=" ";
    if (isset($_POST['submit'])) {
        $bookname = stripslashes($_REQUEST['bookname']); 
        $bookname = mysqli_real_escape_string($con, $bookname);
        $authorname = stripslashes($_REQUEST['authorname']);
        $authorname = mysqli_real_escape_string($con, $authorname);
        $price = stripslashes($_REQUEST['price']);
        $price = mysqli_real_escape_string($con, $price);
        //$catagory = stripslashes($_REQUEST['catagory[]']);
        //$catagory = mysqli_real_escape_string($con, $catagory);
        $catagory='';
        if(!empty($_POST['catagory'])) {
            foreach($_POST['catagory'] as $check) {
                    $catagory.=','.$check; 
            }
        }

               
        $target_dir = "bookimg/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $uploadOk = 1;

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          if ($_FILES["fileToUpload"]["size"] > 800000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
                echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
            $uploadOk = 0;
            }

        
        if ($uploadOk == 1){
        $query="insert into bookinfo (bookname,authorname,price,img,catagory) values ('$bookname','$authorname','$price','$target_file','$catagory')";
        $result = mysqli_query($con, $query);

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $msg="Book succesfully added.";
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<form class="form" method="post" action="<?php echo $_server["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <h1 class="login-title">Add a Book</h1>
        <input type="text" class="login-input" name="bookname" placeholder="Book Name" autofocus="true" required/>
        <div style="height: 100px;" class="login-input">
        <input type="checkbox"  name="catagory[]" value="Adventure">
        <label for="vehicle1"> Adventure</label><br>
        <input type="checkbox"  name="catagory[]" value="Fiction">
        <label for="vehicle2"> Fiction</label><br>
        <input type="checkbox"  name="catagory[]" value="Thriller">
        <label for="vehicle3"> Thriller</label><br>
        <input type="checkbox" name="catagory[]" value="Biography">
        <label for="vehicle3"> Biography</label><br>
        <input type="checkbox" name="catagory[]" value="Romance">
        <label for="vehicle3"> Romance</label><br><br>
        </div>
        <input type="text" class="login-input" name="authorname" placeholder="Author Name" required/>
        <input type="text" class="login-input" name="price" placeholder="Price" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required/>
        <img src="<?php echo $row['img'];?>" width="60" >
        <input type="file" class="login-input" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Add" name="submit" class="login-button"/>
        <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <a href="allbooks.php" ><input type="button" value="Show all Books"/></a>
        <?php 
        echo $msg; 
        ?>
  </form>

</body>
</html> 