<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");
$userid=$_SESSION['userid'];
$vpwd=mysqli_escape_string($con,$_POST['vpwd']);

$password=$_SESSION['password'];
if ($vpwd==$password){
    echo "1";
} else {
    echo "0";
}



?>