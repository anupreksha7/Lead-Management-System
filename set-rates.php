<!--set new rates for mailing and calling a lead to procure it-->
<?php 

  require 'css/css.html';
  require 'db.php';?>
  <style type="text/css">
  <?php require 'css/style.css'; ?>
</style>

<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
      if (isset($_POST['set'])) { 
      //updating new rates
      $mail = $mysqli->escape_string($_POST['mail']);
      $call = $mysqli->escape_string($_POST['call']);

      $inst = $mysqli->query("update rates set mailing = '$mail' , calling = '$call' where id = 1");

        if ($inst)
        {
            require 'admin-profile.php';
        }

        else{
            $_SESSION['message'] = "Improper value";
                header("location: error.php");
            }
        }

    }
?>

<div id="signup">   
          <div class="form2">
            <h1 class="headings">Current Rates</h1><br>
          <form action="" method="post" autocomplete="off">
          <div class="form-group">
          <div class="top-row">
              <label>
                Cost of sending a mail <span class="req">*</span>
              </label>
              <input class="form-control" type="text" name='mail' />
            </div>
        
            <div class="form-group">
              <label>
                Cost of making a call<span class="req">*</span>
              </label>
              <input type="text"  name='call' class="form-control" />
            </div>
          </div>
          
          <div class="form-group">
          <button type="submit" class="btn btn-block form-control btn btn-primary" name="set" />Set</button>
          </div>
          </form>

        </div>  
      
</div> <!-- /form -->
</body>
</html>