<?php
    session_start();
    error_reporting(0);
    include('auth_session.php');
    require('db.php');
    $fatherfname=$_SESSION['fatherfname'];
    $motherfname=$_SESSION['motherfname'];

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


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){ 

	$('#verify').click(function(){
		var vpwd =$('input[id$=vpwd]').val();
			$.post("verifypwd.php",{vpwd:vpwd}, function(returndata) {
                
				if (returndata=="1"){   
                   document.getElementById('fatherfname').disabled=false;
                   document.getElementById('motherfname').disabled=false;
                   document.getElementById('fatherfname').value="<?php echo $fatherfname; ?>";
                   document.getElementById('motherfname').value="<?php echo $motherfname; ?>";
                   
                   $('#verify').hide(400);
                   $('#vpwd').hide(400);
                   document.getElementById('vpbtn').disabled=false;                                                
                } else {
                    alert("Wrong Password");
                
                }
			})
			
	})

    $('#vpbtn').click(function(){
        var fatherfname =$('input[id$=fatherfname]').val();
        var motherfname =$('input[id$=motherfname]').val();
        $.post("updatesecretanswer.php",{fatherfname:fatherfname,motherfname:motherfname}, function(returndata) {
            if (returndata=="1"){
                alert("Updated Sucessfully");
                
            }

        })


    });


    
})

</script>




<form class="form" method="post" action="<?php echo $_server["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <h1 class="login-title">Update your secret answers</h1>
        <input type="password" class="login-input" id="vpwd" style="width: 130px;"  placeholder="Password" autofocus="true" required/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Verify" id="verify" class="login-button" style="width: 130px;"/>
        <input type="text" class="login-input" id="fatherfname" name="fatherfname" disabled placeholder="Father's first name" autofocus="true" required/>
        <input type="text" class="login-input" id="motherfname" name="motherfname" disabled placeholder="Mother's first name" required/>
        <input type="submit" value="Update" id="vpbtn" disabled name="vpbtn" class="login-button"/>
        <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <?php 
        echo $msg; 
        ?>
  </form>

</body>
</html> 