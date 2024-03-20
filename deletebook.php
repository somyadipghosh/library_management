<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");
$sno=stripslashes($_GET['sno']);
$sno=mysqli_real_escape_string($con, $sno);
$query= "delete from bookinfo where sno='$sno'";
$result = mysqli_query($con, $query);
$rows = mysqli_num_rows($result);
header('location:allbooks.php');
?>