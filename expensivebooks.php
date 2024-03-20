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
<div class="text-center"><h2>Expensive Books</h2></div>

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
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>


<div id="tblediv">
<table class="styled-table">
<thead>
<tr class="active-row">
      <th>SNo.</th>
      <th>Book Name</th>
      <th>Picture</th>
      <th>Author Name</th>
      <th>Price</th>      
</tr>
</thead>
<?php

$query="SELECT * FROM bookinfo WHERE price>1000";
$result = mysqli_query($con, $query);
$total=0;
$x=0;
 while($row=mysqli_fetch_array($result))
 {
    $x++;
    $total+=$row['price'];
?>
<tbody>
    <tr class="active-row">
    <td><?php echo $x;?></td>
      <td><?php echo $row['bookname'];?></td>
      <td><a href="<?php echo $row['img'];?>" data-lightbox="<?php echo $row['img'];?>" data-title="<?php echo $row['bookname'];?>"><img src="<?php echo $row['img'];?>" width="60" style="cursor: pointer;" ></a></td>
      <td><?php echo $row['authorname'];?></td>
      <td><?php echo "₹".$row['price'];?></td>     
    </tr>
</tbody>
<?php } ?>
</table>
 </div>
<div>
<p>Total number of books: <?php echo $x ?></p>
<p>Total amount of all books: <?php echo "₹".$total; ?></p>


</div>
</body>
</html>