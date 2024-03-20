<link rel="stylesheet" href="style.css"/>
<?php
    session_start();
    error_reporting(0);
    require('db.php');
    include('auth_session.php');
    $msg="";
    $er=1;
    $sno = stripslashes($_GET['sno']); 
    $sno = mysqli_real_escape_string($con, $sno);

    $q=mysqli_query($con,"select sno from bookissue where bookid='$sno' and status=0 ");
    if (mysqli_num_rows($q)>0){
      echo "<div class='form'>
      <h3>Book already issued.</h3><br/>
      <p class='link'>Click here to <a href='allbooks.php'>issue another book</a> again.</p>
      </div>";exit();
    }


    $query="select * from bookinfo where sno='$sno'";
    $result = mysqli_query($con, $query);
    $row=mysqli_fetch_assoc($result);

    $query1="select srno,membername from members where status=0"; 
    $result1 = mysqli_query($con, $query1);



    if (isset($_POST['submit'])) {
      $msg="";
      $membername = stripslashes($_REQUEST['membername']); 
      $membername = mysqli_real_escape_string($con, $membername);
      $bookid = stripslashes($_REQUEST['bookid']); 
      $bookid = mysqli_real_escape_string($con, $bookid);
      $days = stripslashes($_REQUEST['days']); 
      $days = mysqli_real_escape_string($con, $days);
      $date1=strtotime(date('Y-m-d'));
      $date2 = strtotime("+".$days." day", $date1);
      $returndate=date('Y-m-d', $date2);

      
      $query2="insert into bookissue (memberid,dated,returndate,bookid,status) values ('$membername',curdate(),'$returndate','$bookid','0')";
      $result2 = mysqli_query($con, $query2);
      $msg="Book issued!";
      
      $q=mysqli_query($con,"update members set status=1 where srno='$membername' ");

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Issue a book</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<form class="form" method="post" action="<?php echo $_server["PHP_SELF"]; ?>">
        <h1 class="login-title">Issue a book</h1>

<div class="login-input">
<label for="cars">Member's Name:</label>
<select name="membername" id="memnername">
<?php while($row1=mysqli_fetch_assoc($result1))
{  
    ?>
  <option value="<?php echo $row1['srno'] ?>"><?php echo $row1['membername'] ?></option>
<?php } ?>
</select>
</div>

        <input type="hidden" name="bookid" value="<?php echo $row['sno']; ?>" >
        <input type="text" class="login-input" name="bookname" readonly placeholder="Book's Name" value="<?php echo $row['bookname']; ?>" required/>


<div class="login-input">
<label for="cars">Days issuing a book:</label>
<select name="days" id="days">
  <option value="1">1 day</option>
  <option value="2">2 days</option>
  <option value="3">3 days</option>
  <option value="4">4 days</option>
  <option value="5">5 days</option>
  <option value="6">6 days</option>
  <option value="7">7 days</option>
  <option value="8">8 days</option>
  <option value="9">9 days</option>
  <option value="10">10 days</option>
  <option value="11">11 days</option>
  <option value="12">12 days</option>
  <option value="13">13 days</option>
  <option value="14">14 days</option>
  <option value="15">15 days</option>
</select>
</div>
        <input type="submit" value="Issue" name="submit" class="login-button"/>
        <a href="dashboard.php" ><input type="button" value="Home"/></a>
        <a href="allmembers.php" ><input type="button" value="Show all members"/></a>
        <a href="allbooks.php" ><input type="button" value="Show all books"/></a>
        <?php
   echo $msg;
  ?>
  </form>
</body>
</html> 