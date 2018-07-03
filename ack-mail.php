<!--mail to users for participation and winning-->
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

//acknowledgement mail to all users
$subject = "Auction Invitation";
$msg = "Thanks for participating. We hope you got better deals. See you next time. \nIf you have won complete the payment and leads will be sent to you.The payment link has been sent to the winners." ;

$users = $mysqli->query("select * from users");
while($id = $users->fetch_assoc()){
    $to = $id['email'];
    send_mail($to,$from,$subject,$msg);
}

//payment link to the lead winners 
$sub = "Final step to get the lead";
$msgp = "The payment link is ....................\nComplete soon to get the details. :)";

$auc = $mysqli->query("select * from auction where aid = (select aid from auction where date = (select min(date) from auction where finished = 0))");
$auction = $auc->fetch_assoc();
$id = $auction['aid'];
$leads = $mysqli->query("select * from leads where aid = '$id' and uid <> 0") or die($mysqli -> error);
while($l=$leads->fetch_assoc()){
    $li = $l['lid'];
    $email = $mysqli->query("select * from users where id = (select uid from leads where lid = '$li')");
    $e = $email->fetch_assoc();
    $eid = $e['email'];
    send_mail($eid,$from,$sub,$msgp);
}

