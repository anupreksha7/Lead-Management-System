<?php
	require 'db.php';
	require 'css/css.html';?>
	<style type="text/css">
  <?php require 'css/style.css'; ?>
</style>

<?php
  session_start();

  //filtering leads according to location
  if(isset($_GET['geo_tag'])){
    $loc = $_GET['loc'];
    $query = $mysqli->query("Select * from leads where on_sale = '0' and location = '$loc' and all_filled = 1");
  }else{
    $query = $mysqli->query("Select * from leads where on_sale = '0' and all_filled  =1") or die($mysqli->error);  
  }
?>

<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      if (isset($_POST['submit'])) {

        //add new auction to database
        $date = $mysqli->escape_string($_POST['date']);
        $time = $mysqli->escape_string($_POST['time']);
        $dur = $mysqli->escape_string($_POST['duration']);
        $inst = $mysqli->query("insert into auction (date,time,duration) values ('$date', '$time', '$dur')");

        $aid = $mysqli->query("select * from auction order by aid desc limit 1");
        $id = $aid->fetch_assoc();
        $i = $id['aid'];

        //setting on_sale of the selected leads and assigning them auction id
        foreach($_POST['auction'] as $auc){
          if($auc){
            $inst = $mysqli->query("update leads set on_sale = 1, aid = '$i' where lid = '$auc'");
          }
        }
        //invitation mail to all registered users
        require 'mail.php';
        //minimum bid calculation of the selected leads
        require 'min-bid.php';
        //redirecting to auction set 
        header("location: auction-set.php");

      }
    }
?>


<!DOCTYPE html>
<title>Lead - Auction</title>
<body>
	<div id="submit"> 
        <div class="form1">
          <h1 class="headings">Auction Details</h1><br>

            <form method="get" action="lead-auction.php">
            <span>Locations: </span>
            <select name="loc">
            <option value="" disabled selected >All cities</option>
            <!--location filter-->
            <?php
            $loc = $mysqli->query("Select distinct(location) from leads where on_sale = 0 and all_filled = 1 and uid = 0");
            while($loc_res = $loc->fetch_assoc()){  ?>
            <option value= "<?= $loc_res['location'] ?>" >
            <?= $loc_res['location'] ?>
          </option>
    <?php } ?>    
    </select>
    <input type="submit" name="geo_tag" value="Go">
  </form>

          <form action="lead-auction.php" method="post" autocomplete="off">
            <div class="form-group">
            <label>
                Minimum Profit<span class="req">*</span>
            </label>
            <input type="number" class="form-control" min = "1"  max = "100" required autocomplete="off" name="min_profit"/>
            </div>
          
            <div class="form-group">
            <label>
              Auction Time<span class="req">*</span>
            </label>
            <input type="Time" class="form-control" required autocomplete="off" name="time"/>
            </div>

            <div class="form-group">
          	<label>
              Auction Date<span class="req">*</span>
            </label>
            <input type="Date" class="form-control" required autocomplete="off" name="date"/>
            </div> 

            <div class="form-group">
            <label>
              Auction Duration<span class="req">*</span>
            </label>
            <input type="Time" class="form-control" required autocomplete="off" name="duration" min="00:30" max="22:00" />
            </div> 
            <!--leads to be put in auction-->
          <div class="form-group">
          <?php while($q = $query->fetch_assoc()){?>
            <input type="checkbox" name="auction[]" value="<?= $q['lid']?>">&nbsp<?= $q['lid']?> &nbsp <?= $q['source']?> &nbsp <?= $q['location']?> &nbsp <?= $q['cost']?> &nbsp <?= $q['cpl']?><br>
          <?php }?>
        </div>

          <div class="form-group">
          <button class="btn btn-block btn btn-primary form-control" name="submit" />Submit</button>
          </div>

        </form>
      </div>
    </div>
  </body>
</html>
