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

<script type="text/javascript">

function showbook(){
    $("#booktable tr:not(:first)").each(function() {        
        $(this).show();
    })
    var searchval=$('input[id$=searchtxt]').val();
    searchval=searchval.toLowerCase();
    colno=2;
    var i=0;
    $("#booktable tr:not(:first)").each(function() { 
        var bookname=$(this).find("td:nth-child("+ colno +")").text();
        bookname=bookname.toLowerCase();
        if (bookname.indexOf(searchval)<0){
            $(this).hide();
        } else {
            i++;
        }
    })
    $('#result').show();
    $('#result').html('Record found: '+ i);
    $('#result').fadeOut(3000);
   

}
</script>



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


<div id="tblediv">
<table class="styled-table" id="booktable" >
<thead>
<tr class="active-row">
      <th>SNo.</th>
      <th>Book Name</th>
      <th>Picture</th>
      <th>Author Name</th>
      <th>Price</th>
      <th>Catagory</th>
      <th>Action</th>
      
</tr>
</thead>
<?php

$query="select * from bookinfo order by bookname";
$result = mysqli_query($con, $query);
$total=0;
$x=0;

$results_per_page = 10;  
$number_of_result = mysqli_num_rows($result);  
$number_of_page = ceil ($number_of_result / $results_per_page);  

if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
 $page_first_result = ($page-1) * $results_per_page; 

 $query = "select * from bookinfo LIMIT " . $page_first_result . ',' . $results_per_page; 
 $result = mysqli_query($con, $query);

 while($row=mysqli_fetch_array($result))
 {
    $x++;
    $total+=$row['price'];
    $cat=str_replace(",","<br>",substr($row['catagory'],1));
    
?>
<tbody>
    <tr class="active-row">
    <td><?php echo $x;?></td>
      <td><?php echo $row['bookname'];?></td>
      <td><a href="<?php echo $row['img'];?>" data-lightbox="<?php echo $row['img'];?>" data-title="<?php echo $row['bookname'];?>"><img src="<?php echo $row['img'];?>" width="60" style="cursor: pointer;" ></a></td>
      <td><?php echo $row['authorname'];?></td>
      <td><?php echo "₹".$row['price'];?></td>
      <td><?php echo $cat;?></td>
      <td><a href="deletebook.php?sno=<?php echo $row['sno']; ?>" ><img src="images/delete.png" width="25" style="cursor: pointer;" ></a>&nbsp;
      <a href="editbook.php?sno=<?php echo $row['sno']; ?>" ><img src="images/edit.png" width="20" style="cursor: pointer;" ></a>&nbsp;
      <a href="editbookimg.php?sno=<?php echo $row['sno']; ?>" ><img src="images/image.png" width="20" style="cursor: pointer;" ></a>&nbsp;
      <a href="issuebook.php?sno=<?php echo $row['sno']; ?>" ><img src="images/issue.png" width="20" style="cursor: pointer;" ></a>&nbsp;
      <a href="returnbook.php?sno=<?php echo $row['sno']; ?>" ><img src="images/return.png" width="20" style="cursor: pointer;" ></a></td>
      
    </tr>
</tbody>
<?php } ?>
</table>

 </div>

<div>
<div style="text-align: center;">
<?php
for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<button type="button" style="margin-right:5px;border-radius:20px" class="btn btn-warning btn-square-md"><a href = "allbooks.php?page=' . $page . '">' . $page . ' </a></button>';  
    }  
?>
</div>
<p>Total number of books: <?php echo $x ?></p>
<p>Total amount of all books: <?php echo "₹".$total; ?></p>
<a href="showallbooks.php">All Books</a>


</div>
</body>
</html>