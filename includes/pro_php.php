
 //    $uname = $_SESSION['user'];
 //    if(isset($_GET['sbmt']))
 //    {
	// 	$stkid = $_GET['stkid'];
	// 	$quant = $_GET['quant'];
	// 	$query5 = $mysqli->query("Select stockrate from stock where sid = '$stkid'") or die($mysqli->error);
	// 	$stkrate = $query5->fetch_assoc();
	// 	$stockrte = $stkrate['stockrate'];
	// 	for($i = 0;$i<$quant;$i++)	
	// 	{
	// 		$amount -= $stockrte;
	// 	}
	// $_SESSION['amount'] = $amount;
	// $query4 = $mysqli->query("Insert into record(userid,stckid,quantity)values('$uid','$stkid','$quant')") or die($mysqli->error);
	// unset($_GET['sbmt']);
	// header("location: profile.php");
}
