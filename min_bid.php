<?php
	require 'db.php';
	$ins_cpl = $mysqli->query("select * from leads");
	while($i_c = $ins_cpl->fetch_assoc()){
		$no_col = 6;
		$name = $ins_cpl['name'];
		$email_id = $ins_cpl['email_id'];
		$contact_no = $ins_cpl['contact_no'];
		$location = $ins_cpl['location'];
		$c_e = $col_empty->fetch_assoc();
		$cost = $i_c['cost'];
		$handling_chrg = $c_e['empty_field_count'] * $cost * 100 / $no_col;
		$cpl = $cost + $handling_chrg;
		$i = $i_c['$lid'];
		$put_cpl = $mysqli->query("update leads set cpl ='$cpl' where lid = '$i'");
	}
	$min_max = $mysqli->query("select max(cpl), min(cpl) from leads");
	$minmax_cpl = $min_max->fetch_assoc();
	$min_cpl = $minmax_cpl['min'];
	$max_cpl = $minmax_cpl['max'];
	$diff = ($max_cpl - $min-cpl)/2;
	while($i_c = $ins_cpl->fetch_assoc()){
		$cpl = $mysqli->query("select cpl from $i_c");
		$cpl_c = $cpl->fetch_assoc(); 
		$nth = int( ($cpl - $min_cpl) / diff -1);
		$min_bid = (($nth-1) + 5 ) * $cpl_c;
		$x = $i_c['$lid'];
	$m_b = $mysqli->query("update leads set min_bid = '$min_bid' where lid = '$x'") ;
}
?>