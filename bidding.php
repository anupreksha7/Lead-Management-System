<!--auction page for dealer where he can bid--->
<?php
require('db.php');
require('css/css.html'); ?>
<style type="text/css">
	<?php require ('css/style.css');	?>
</style>
<?php
	
	session_start();

	$uid = $_SESSION['id'];
	$name = $_SESSION['name'];

	//updating current bid and current winner according to user and his bid
	if(isset($_GET['bid_sub']) and isset($_GET['mybid'])){
			$mybid = $_GET['mybid'];
			$lid = $_GET['bid_sub'];
			$q = $mysqli->query("Select cost from leads where lid = '$lid'");
			$r = $q->fetch_assoc();
			 $curbid = $r['min_bid'];
			if($mybid >= $curbid){
				$q1 = $mysqli->query("update leads set min_bid = '$mybid', uid = '$uid' where lid = '$lid'");
			}
	}

	//filtering leads according to location
	if(isset($_GET['geo_tag'])){
		$loc = $_GET['loc'];
		$query = $mysqli->query("Select * from leads where on_sale = '1' and location = '$loc'");
	}else{
		$query = $mysqli->query("Select * from leads where on_sale = '1'") or die($mysqli->error);	
	}
?>

<?php
//fetching date and time of auction
		//first upcoming auction
		$auc = $mysqli->query("select * from auction where aid = (select aid from auction where date = (select min(date) from auction where finished = 0))");
		$auction = $auc->fetch_assoc();
        $auc_date = $auction['date'];
        $y = $auc_date[0].$auc_date[1].$auc_date[2].$auc_date[3];
        $m = $auc_date[5].$auc_date[6];
        $d = $auc_date[8].$auc_date[9];
        $auc_time = $auction['time'];
        $h = $auc_time[0].$auc_time[1];
        $mm = $auc_time[3].$auc_time[4];
        $auc_dur = $auction['duration'];
        $d_h = $auc_dur[0].$auc_dur[1];
        $d_m = $auc_dur[3].$auc_dur[4];

      ?>
      <!--passing php variables to javascript-->
        <script type="text/javascript">var y = "<?= $y ?>";
                                       var m = "<?= $m ?>";
                                       var d = "<?= $d ?>";
                                       var h = "<?= $h ?>";
                                       var mm ="<?= $mm ?>";
                                       var d_h ="<?= $d_h ?>";
                                       var d_m ="<?= $d_m ?>";
        </script>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hello Mr. <?= $_SESSION['name'] ?></title>
</head>
<body>
	<div class="container">
		<div class = "jumbotron">
			<h1 id="heading">Welcome to Lead Auction System</h1>
			<h3 style="text-align: left">Hello Mr. <?= $name ?></h3>
			<h4 style="text-align: right">User id: ###<?= $uid ?></h4>
		</div>
	</div>
	<!--timer for auction-->
	<span style="text-align: center"><p style="font-size: 25px;">Auction ends in:</p><div style="font-size: 43px;" id="divCounter"></div></span>
	<div class="loc-filter">
	<span class="sub-title">Leads On Auction: </span>
	<div class="locatn">
	<form method="get" action="profile.php">
		<span>Locations: </span>
		<select name="loc">
			<option value="" disabled selected >All cities</option>
			<?php
				$loc = $mysqli->query("Select distinct(location) from leads");
				while($loc_res = $loc->fetch_assoc()){	?>
					<option value= "<?= $loc_res['location'] ?>" >
						<?= $loc_res['location'] ?>
					</option>
		<?php } ?>		
		</select>
		<input type="submit" name="geo_tag" value="Go">
	</form>	
	</div>
	</div>
	<div class="content-area">
		<table class="table">
			<thead>
				<tr>
				<th scope="col">Lead Name</td>
				<th scope="col">Location</td>
				<th scope="col">Current Bid</th>
				<th scope="col">Winning User ID</th>
				<th scope="col">Your Bid</th>
				</tr>
			</thead>
			<tbody>
				<?php while($result = $query->fetch_assoc()){ ?>
				<tr>
					<td><?= $result['name'] ?></td>
					<td><?= $result['location'] ?></td>
					<td><?= $result['min_bid'] ?></td>
					<td>###<?= $result['uid'] ?></td>
					<td>
						<form method="get" action="bidding.php">
							<input type="number" min="1" name="mybid">
							<button name="bid_sub" value="<?= $result['lid'] ?>">
								<i class="fas fa-sign-in-alt"></i></button>
							</form>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
		<a href="logout.php" class="btn btn-outline-danger logout btn-block">Log Out</a>	

<script type="text/javascript" src="js/auc-timer.js"></script>
</body>
</html>