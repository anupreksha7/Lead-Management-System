<!--mail to winners sending them the details of lead they won-->
<?php
require('db.php');
require('css/css.html'); ?>
<style type="text/css">
    <?php require ('css/style.css');    ?>
</style>


<?php

function send_mail($to,$from,$subject,$msg){
  
    $headers ="MIME-Version: 1.0 
";
    $headers.="from: $from  $subject  
";
    $headers.="Content-type: text/html;charset=utf-8 
";
    $headers.="X-Priority: 3
";
    $headers.="X-Mailer: smail-PHP ".phpversion()."
";
    $msg    ='
    <div style="text-align:left">
    '.$msg.'
    </div>
    ';
 
    if( mail($to,$subject,$msg,$headers) ){
        return true;
    }else{
        return false;
    }
}

$from = AuthUser;

//lead details to the lead winners after the payment
$sub = "Lead you won";
//paid leads
$leads = $mysqli->query("select * from leads where paid = 1 and uid <> 0") or die($mysqli -> error);
while($l = $leads->fetch_assoc()){
    //lead info
    $li = $l['lid'];
    $name = $l['name'];
    $mailid = $l['email_id'];
    $contact = $l['contact_no'];
    $location = $l['location'];
    //lead winner
    $email = $mysqli->query("select * from users where id = (select uid from leads where lid = '$li')");
    $e = $email->fetch_assoc();
    $eid = $e['email'];
    $msg = "Congratulations!!! <br> The lead is all yours: <br> Name: ".$name." <br> Email id: ".$mailid." <br> Contact: ".$contact." <br> Location: ".$location" <br> Thankyou. :)";
    send_mail($eid,$from,$sub,$msg);
}

