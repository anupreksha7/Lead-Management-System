<!--dealers profile-->
<?php
require('db.php');
require('css/css.html'); ?>
<style type="text/css">
	<?php require ('css/style.css');	?>
</style>
<?php
	session_start();

	//user logging check
	if($_SESSION['logged_in'] != 1)
	{
	$_SESSION['message']="You have to log in to visit your profile!";
	header("location: error.php");
	}
	else
	{
	$uid = $_SESSION['id'];
	$name = $_SESSION['name'];
	}
?>

<?php
//passing date and time for timer
		//the first upcoming auction
		$auc = $mysqli->query("select * from auction where aid = (select aid from auction where date = (select min(date) from auction where finished = 0))");
		$auction = $auc->fetch_assoc();
        $auc_date = $auction['date'];
        $y = $auc_date[0].$auc_date[1].$auc_date[2].$auc_date[3];
        $m = $auc_date[5].$auc_date[6];
        $d = $auc_date[8].$auc_date[9];
        $auc_time = $auction['time'];
        $h = $auc_time[0].$auc_time[1];
        $mm = $auc_time[3].$auc_time[4];
      ?>
      <!--passing php variables for timer-->
        <script type="text/javascript">var y = "<?= $y ?>";
                                       var m = "<?= $m ?>";
                                       var d = "<?= $d ?>";
                                       var h = "<?= $h ?>";
                                       var mm ="<?= $mm ?>";
        </script>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hello Mr. <?= $name ?></title>
	<!--enabling the participation link-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
</head>
<body>
	<div class="container">
		<div class = "jumbotron">
			<h1 id="heading">Welcome to Lead Auction System</h1>
			<h3 style="text-align: left">Hello Mr. <?= $name ?></h3>
			<h4 style="text-align: right">User id: ###<?= $uid ?></h4>
		</div>
	</div>
	<span style="text-align: center"><p style="font-size: 25px;">Auction starts in:</p><div style="font-size: 43px;" id="divCounter"></div></span>
	<!-- link to participate which is enabled once auction starts--->
	<div id ="hello" class="Participate" style="text-align: center; font-size: 35px">
  	<a href="bidding.php" title="Link">Participate
	</a>
</div>
			<a href="logout.php" class="btn btn-outline-danger logout btn-block">Log Out</a>	

<script type="text/javascript" src="js/timer.js"></script>
</body>
</html>