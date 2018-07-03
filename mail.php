<!--invitation mail to all users for upcoming auction-->
<?php
require('db.php');
require('css/css.html'); ?>
<style type="text/css">
    <?php require ('css/style.css');    ?>
</style>


<?php
//finding the (starting) minimum bid of a lead in the upcoming auction and auction details 
$aid = $mysqli->query("select * from auction order by aid desc limit 1");
$id = $aid->fetch_assoc();
$i = $id['aid']; 
$date = $id['date'];
$time = $id['time'];
$duration = $id['duration'];
$minbid = $mysqli->query("select min(min_bid) from leads where on_sale = 1 and aid = '$i'");
$mbid = $minbid->fetch_assoc();
$bid = $mbid['min(min_bid)'];

//mail
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
$subject = "Auction Invitation";
$msg = "Our new auction of leads will start on ".$date." at ".$time." and will last for ".$duration." hours only. Starting with minimum bid of Rs ".$bid.".<br>Best Opportunity to buy leads. <br> See you there." ;

//all users
$users = $mysqli->query("select * from users");
while($id = $users->fetch_assoc()){
    $to = $id['email'];
    send_mail($to,$from,$subject,$msg);
}
?>
