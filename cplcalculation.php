<!--calculate cpl of recently added lead-->
<?php 	
        //current mailing and calling rates to claculate handling charges
		$rates = $mysqli->query("select * from rates where id = 1");
        $r = $rates->fetch_assoc();
        $mail = $r['mailing'];
        $call = $r['calling'];

        //recently added lead
        $ins_cpl = $mysqli->query("select * from leads order by lid desc limit 1");
        $i_c = $ins_cpl->fetch_assoc();
        
        //finding empty columns
        $emp = 0;
        if(empty($i_c['email_id'])){
            $emp = $emp + 1;
        }
        if(empty($i_c['contact_no'])){
            $emp = $emp + 1;
        }

        //handling charges
        $handling_chrg = ($mail + $call) / 2;

        //cpl
        $cost = $i_c['cost'];
        $cpl = $cost + ($handling_chrg * $emp);
        $i = $i_c['lid'];

        //inserting value of cpl and all_filled (columns)
        $put_cpl = $mysqli->query("update leads set cpl ='$cpl' where lid = '$i'");
        if($emp > 0){
            $mysqli->query("update leads set all_filled = 0 where lid = '$i'");
        }

?>