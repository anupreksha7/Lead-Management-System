
var finishedtext = "Auction starts";
var end1;

//auction date and time
end1 = new Date(y,m-1,d,h,mm);

var counter = function () {
//date and time at the time of login
var now = new Date();
var diff = end1 - now;

diff = new Date(diff);

var milliseconds = parseInt((diff%1000)/100)
    var sec = parseInt((diff/1000)%60)
    var mins = parseInt((diff/(1000*60))%60)
    var hours = parseInt((diff/(1000*60*60))%24);
    var days = Math.floor(diff / (1000*60 * 60 * 24));

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
} else {
    var value = hours + "h" + mins + "m" + sec + "s"; 
    if(days){
        var value = days+ "d" +hours + "h" + mins + "m" + sec + "s"; 
    } 
    document.getElementById('divCounter').innerHTML = value;
    $("#hello a").click(function(e){
    e.preventDefault();});
    }
}
var interval = setInterval(counter, 1000);
