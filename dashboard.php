<?php
session_start();
error_reporting(0);
require('db.php');
include("auth_session.php");



?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="mystyle.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script.js"></script>
<!------ Include the above in your HEAD tag ---------->


<div class="text-center"><h2>Library Project - <?php echo $_SESSION['username']; ?></h2> </div>

<div id="menu_area" class="menu-area">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-light navbar-expand-lg mainmenu">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                        
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Books</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="addbook.php">Add a book</a></li>
                            <li><a href="allbooks.php">Show all books</a></li>
                            <li><a href="expensivebooks.php">Show expensive books</a></li>
                            
                        </li>
                    </ul>
                    <li class="dropdown">
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Members</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="addmembers.php">Add a member</a></li> 
                            <li><a href="allmembers.php">Show all members</a></li>
                            <li><a href="nonissuingmember.php">Show non issuing members</a></li>
                        </li>
                    </ul>
                    <li class="dropdown">
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="settings.php">Change Password</a></li> 
                            <li><a href="secretanswer.php">Update Secret Member</a></li>
                        </li>
                    </ul>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>


<br>
  
