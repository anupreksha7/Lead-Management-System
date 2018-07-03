
var finishedtext = "Countdown Finished";
var end1;
//adding duration to date of auction
h = parseInt(h) + parseInt((parseInt(mm) + parseInt(d_m))/60) + parseInt(d_h);
mm =(parseInt(mm) + parseInt(d_m))%60;
d = parseInt(d) + parseInt(parseInt(h)/24);
h = parseInt(h)%24;

//date and time at which auction ends
end1 = new Date(y,m-1,d,h,mm);
var counter = function () {
//date and time at the time of login
var now = new Date();
var diff = end1 - now;

diff = new Date(diff);

var milliseconds = parseInt((diff%1000)/100)
    var sec = parseInt((diff/1000)%60)
    var mins = parseInt((diff/(1000*60))%60)
    var hours = parseInt(diff/(1000*60*60));

if (mins < 10) {
    mins = "0" + mins;
}
if (sec < 10) { 
    sec = "0" + sec;
}  
if (hours < 10) { 
    hours = "0" + hours;
} 

if(now >= end1) {     
    clearTimeout(interval);
    document.getElementById('divCounter').innerHTML = finishedtext;
    if(confirm("TIME UP!")){
        window.location = "thankyou.php";
    }

} else {
    var value = hours + "h" + mins + "m" + sec + "s"; 
    document.getElementById('divCounter').innerHTML = value;
}
}
var interval = setInterval(counter, 1000);
