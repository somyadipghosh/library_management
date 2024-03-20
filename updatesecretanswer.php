<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");
$userid=$_SESSION['userid'];

$fatherfname=mysqli_escape_string($con,$_POST['fatherfname']);
$motherfname=mysqli_escape_string($con,$_POST['motherfname']);

$query="update users set fatherfname='$fatherfname',motherfname='$motherfname' where id='$userid'";
$result = mysqli_query($con, $query);
if ($result){
    echo "1";
} else {
    echo "0";
}

?>