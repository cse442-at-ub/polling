


function js_redirect(theUrl){
    // the inital request to theUrl, only call once.
    location.href = theUrl;
}


/*for thank_submission.php page*/
 function js_countDown_redirect(theUrl, time_ms){
    var seconds = 5;
    var counting = setInterval(function(){
        seconds -= time_ms/1000;
        document.getElementById("count").innerText = seconds;
        if (seconds<=0){
        location.href="see_result.php";
        }
    },
    time_ms
    )
}


/* it's for see_result.php page will reload page every 1 second/ every time_ms */
function reload_after(time_ms){

    // will call this function after time_ms millisecond
    var call_func_everyInterval = setTimeout(js_requestReload, time_ms);
}

function js_requestReload(){
    location.reload();
    console.log("sup");
}