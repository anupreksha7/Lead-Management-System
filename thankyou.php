<!--terminating page of auction-->
<?php
require('css/css.html'); ?>
<style type="text/css">
	<?php require ('css/style.css');	?>
</style>
<?php
	require 'db.php';
	session_start();
	$query = $mysqli->query("Update leads set on_sale = '0' where uid = '0'");
	session_unset();
	session_destroy();
	//o mail all the users and winner to pay
	require 'ack-mail.php';
?>
<?php
//ongoing auction is finished
	$auc = $mysqli->query("select * from auction where aid = (select aid from auction where date = (select min(date) from auction where finished = 0))");
	$auction = $auc->fetch_assoc();
	$id = $auction['aid'];
	$com = $mysqli->query("update auction set finished = 1 where aid = '$id'");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Thanks!</title>
</head>
<body>
	<div>
		Thanks a lot for your active participation.
	</div>
	<div>
		The leads you bought will be send to you via email.<br>
		<a href="index.php"><button class="button button-block"/>Home</button></a>
	</div>

</body>
</html>