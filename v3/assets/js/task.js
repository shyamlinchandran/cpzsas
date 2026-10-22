var i = 0;
var _base_url = ''
function timedCount() {
    xhr.open("GET", _base_url + "dashboard/getsession");
    xhr.onload = function () {
        postMessage(xhr.responseText); 
    };
    xhr.send();
    setTimeout("timedCount()", 15000);
}


var xhr = new XMLHttpRequest();
onmessage = function (e) {
    _base_url = e.data 
    timedCount();

};

//timedCount(); 