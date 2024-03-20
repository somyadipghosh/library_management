<?php
session_start();
error_reporting(0);
require('db.php');
//include auth_session.php file on all user panel pages
include("auth_session.php");

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>Books</title>
<link rel="stylesheet" href="style.css" >
<link href="lightbox.min.css" rel="stylesheet" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="mystyle.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script.js"></script>
<script src="lightbox-plus-jquery.min.js"></script>


</head>
<!------ Include the above in your HEAD tag ---------->

<body>


<div class="text-center"><h2>All Books</h2></div>

<div id="menu_area" class="menu-area">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-light navbar-expand-lg mainmenu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="active"><a href="dashboard.php">Home <span class="sr-only"></span></a></li>
                        <li class="active"><a href="addbook.php">Add a book<span class="sr-only"></span></a></li>
                        <div style="padding: 10px;">
                           <input type="search" id="searchtxt" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                           <button type="button" id="searchbtn" onclick="showbook()" class="btn btn-outline-light"><img src="images/search.png" width="20" style="cursor: pointer;" ></button>
                        </div>
                        <li class="active"><a href="allbooks.php"><img src="images/reset.png" title="Reset" width="20" style="cursor: pointer;" ><span class="sr-only"></span></a></li>
                        <div id="result" style="padding: 10px;color:white"></div>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<?php

 $query = "select * from bookinfo order by bookname"; 
 $result = mysqli_query($con, $query);
 
 
 while($row=mysqli_fetch_array($result))
 {

    $cat=str_replace(",","<br>",substr($row['catagory'],1));
    
?>   <div class="mytblediv">
      <div><a href="<?php echo $row['img'];?>" data-lightbox="<?php echo $row['img'];?>" data-title="<?php echo $row['bookname'];?>"><img src="<?php echo $row['img'];?>"  width="60" style="cursor: pointer;" ></a></div>
      <div><?php echo $row['bookname'];?></div>
      <div><?php echo $row['authorname'];?></div>
      <div><?php echo "₹".$row['price'];?></div>
      <div><?php echo $cat;?></div>
     </div>

<?php } ?>
</div>
</body>
</html>