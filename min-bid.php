<!--calculating minimum bid for a lead-->
<?php
	require 'db.php';
	//minimum profit for this auction(recently added)
	$min_profit = $_POST['min_profit'];

	//recently added auction
	$aid = $mysqli->query("select * from auction order by aid desc limit 1");
    $id = $aid->fetch_assoc();
    $i = $id['aid'];

    //minimum and maximum cpl of the leads added to this auction(recently added)
	$min_max = $mysqli->query("select max(cpl) as max, min(cpl) as min from leads where on_sale =1 and aid = '$i'");
	$minmax_cpl = $min_max->fetch_assoc();
	$min_cpl = $minmax_cpl['min'];
	$max_cpl = $minmax_cpl['max'];
	$diff = ($max_cpl - $min_cpl)/2;
	$ins_cpl = $mysqli->query("select * from leads where on_sale = 1 and aid = '$i'");

	//calculating for the leads of this auction and updating in database
	while($i_c = $ins_cpl->fetch_assoc()){
		$cpl = $i_c['cpl'];
		$nth = 0;
		if($diff){
			$nth = (int)(($cpl - $min_cpl) / $diff);
		}
		$min_bid = ((($nth + $min_profit) * $cpl) / 100) + $cpl;
		$x = $i_c['lid'];
	    $m_b = $mysqli->query("update leads set min_bid = '$min_bid' where lid = '$x'");
}
?>
