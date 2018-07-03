<!--admin login-->
<?php 
require 'css/css.html';
require 'db.php';?>
<style type="text/css">
  <?php require 'css/style.css'; ?>
</style>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
</head>


<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //admin logging in

        //user is phpmyadmin user and password is phpmyadmin password
        if($_POST['user'] == $user){
        	if($_POST['password'] == $pass){
        		header ("location: admin-profile.php");
        	}
        	else{
        		$_SESSION['message'] = "You have entered wrong password, try again!";
        		header("location: error.php");
        	}
        }
        else{
        	$_SESSION['message'] = "You are not an admin.. Move from here!!";
        	header("location: error.php");
        }
        
    }
}
?>

<body>
        <h1>Admin Login</h1>
        <div class="intro">
              
        </div>
        <div id="login"> 
        <div class="form1">
          <h1 class="headings">Login</h1><br>
          <form action="" method="post" autocomplete="off">
            <div class="form-group">
            <label>
                user<span class="req">*</span>
            </label>
            <input type="text" class="form-control" required autocomplete="off" name="user"/>
            </div>
          
            <div class="form-group">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" class="form-control" required autocomplete="off" name="password"/>
            </div>
          
          <div class="form-group">
          <button class="btn btn-block btn btn-primary form-control" name="login" />Log In</button>
          </div>
        </form>
      </div>
    </div>