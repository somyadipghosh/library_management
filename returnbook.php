<link rel="stylesheet" href="style.css"/>
<?php
session_start();
error_reporting(0);
require('db.php');
include('auth_session.php');
$msg="";
    
if (isset($_POST['submit'])) {

  $memberid = stripslashes($_REQUEST['memberid']); 
  $memberid = mysqli_real_escape_string($con, $memberid);
  $bookid = stripslashes($_REQUEST['bookid']);    
  $bookid = mysqli_real_escape_string($con, $bookid);

  $q1=mysqli_query($con,"update bookissue set status='1' where bookid='$bookid'");
  $q2=mysqli_query($con,"update members set status='0' where srno='$memberid'");
  echo "<div class='form'><p class='link'>Book Returned!. <a href='allbooks.php'>Show All Books</a></p></div>";exit();
}

    $sno = stripslashes($_GET['sno']); 
    $sno = mysqli_real_escape_string($con, $sno);

    
    
    $q=mysqli_query($con,"select sno from bookissue where bookid='$sno' and status='0' ");
    if (mysqli_num_rows($q)==0){
      echo "<div class='form'>
      <h3>Book isn't issued yet</h3><br/>
      <p class='link'>Click here to <a href='allbooks.php'>return another book</a> again.</p>
      </div>";exit();
    } 


    $query1="SELECT b.sno,i.bookname,i.sno as bsno,m.membername,m.srno,DATE_FORMAT(b.returndate,'%d-%m-%Y') as returndate FROM bookissue b INNER JOIN members m ON b.memberid=m.srno
    INNER JOIN bookinfo i ON i.sno=b.bookid WHERE b.bookid='$sno' ";
    
    $result1 = mysqli_query($con, $query1);
    $row1=mysqli_fetch_assoc($result1);

    $date2=date_create(date('d-m-Y'));
    $date1=date_create($row1['returndate']);
    $d=date_diff($date1,$date2);
    $dd=$d->format('%R%a');
    
    $penalty=0;
    if ($dd>0){
      $penalty=$dd * 50;
    }
    

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Return a book</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<form class="form" method="post" action="<?php echo $_server["PHP_SELF"]; ?>">
<h1 class="login-title">Return Book</h1>
<input type="hidden" name="bookid" value="<?php echo $row1['bsno']; ?>">
<input type="hidden" name="memberid" value="<?php echo $row1['srno']; ?>">
<h3 class="login-title">Book name: </h3><input type="text" class="login-input" name="bookname" readonly  value="<?php echo $row1['bookname']; ?>"/>
<h3 class="login-title">Member name: </h3><input type="text" class="login-input" name="membername" readonly  value="<?php echo $row1['membername']; ?>"/>
<h3 class="login-title">Return Date: </h3><input type="text" class="login-input" name="returndate" readonly  value="<?php echo $row1['returndate']; ?>"/>
<h3 class="login-title">Penalty: </h3><input type="text" class="login-input" name="penalty" readonly  value="<?php echo $penalty; ?>"/>
<input type="submit" value="Return" name="submit" class="login-button"/>
       <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <a href="allmembers.php" ><input type="button" value="Show all members"/></a>
        <a href="allbooks.php" ><input type="button" value="Show all books"/></a>
        <?php
        echo $msg;
        ?>
</form>
</body>
</html> 