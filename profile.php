<?php
require('db.php');
require('css/css.html'); ?>
<style type="text/css">
	<?php require ('css/style.css');	?>
</style>
<?php
	session_start();

	if($_SESSION['logged_in'] != 1)
	{
	$_SESSION['message']="You have to log in to visit your profile!";
	header("location: error.php");
	}
	else
	{
	$uid = $_SESSION['id'];
	$name = $_SESSION['name'];
	if(isset($_GET['bid_sub']) and isset($_GET['mybid'])){
			$mybid = $_GET['mybid'];
			$lid = $_GET['bid_sub'];
			$q = $mysqli->query("Select cost from leads where lid = '$lid'");
			$r = $q->fetch_assoc();
			 $curbid = $r['cost'];
			if($mybid >= $curbid){
				$q1 = $mysqli->query("update leads set cost = '$mybid', uid = '$uid' where lid = '$lid'");
			}
	}
	if(isset($_GET['geo_tag'])){
		$loc = $_GET['loc'];
		$query = $mysqli->query("Select * from leads where on_sale = '1' and location = '$loc'");
	}else{
		$query = $mysqli->query("Select * from leads where on_sale = '1'") or die($mysqli->error);	
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hello Mr. <?= $name ?></title>
</head>
<body>
	<div class="container">
		<div class = "jumbotron">
			<h1 id="heading">Welcome to Lead Auction System</h1>
			<h3 style="text-align: left">Hello Mr. <?= $name ?></h3>
			<h4 style="text-align: right">User id: ###<?= $uid ?></h4>
		</div>
	</div>
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
					<td><?= $result['cost'] ?></td>
					<td>###<?= $result['uid'] ?></td>
					<td>
						<form method="get" action="profile.php">
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

<script type="text/javascript" src="js/timer.js"></script>>
</body>
</html>