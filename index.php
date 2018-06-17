<?php 
/* Main page with two forms: sign up and log in */
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
  <title>Lead Auction System</title>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>
<body>
        <h1>Welcome to Lead Auction System</h1>
        <div class="intro">
              
        </div>
        <div id="login"> 
        <div class="form1">
          <h1 class="headings">Login</h1><br>
          <form action="index.php" method="post" autocomplete="off">
            <div class="form-group">
            <label>
                Email<span class="req">*</span>
            </label>
            <input type="text" class="form-control" required autocomplete="off" name="email"/>
            </div>
          
            <div class="form-group">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" class="form-control" required autocomplete="off" name="password"/>
            </div>
          
          <!-- <p class="forgot"><a href="forgot.php">Forgot Password?</a></p> -->
          <div class="form-group">
          <button class="btn btn-block btn btn-primary form-control" name="login" />Log In</button>
          </div>
        </form>
      </div>
    </div>
          <h1 class="or">OR</h1>
        <div id="signup">   
          <div class="form2">
            <h1 class="headings">Register to start bidding</h1><br>
          <form action="index.php" method="post" autocomplete="off">
          <div class="form-group">
          <div class="top-row">
              <label>
                Name<span class="req">*</span>
              </label>
              <input class="form-control" type="text" required autocomplete="off" name='full' />
            </div>
        
            <div class="form-group">
              <label>
                Email<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off" name='email' class="form-control" />
            </div>
          </div>
          
          <div class="form-group">
            <label>
              Password<span class="req">*</span>
            </label>
            <input class="form-control" type="password"required autocomplete="off" name='pass'/>
          </div>
          
          <div class="form-group">
          <button type="submit" class="btn btn-block form-control btn btn-primary" name="register" />Register</button>
          </div>
          </form>

        </div>  
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
