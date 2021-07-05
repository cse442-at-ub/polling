
// it will return the node object, the [0] here means pointing to the first button
// var x = document.getElementsByTagName("button")[0].attributes.item(0);
// document.getElementById("display_thing").innerHTML = x;

var timer=null;

/*this function feature check whether the poll started or not every 2 second.*/
function ajax_check_pollStarted(){
    timer = setInterval(ajax_load_pollStarted, 1000);
    console.log(typeof timer)
}

/*request the display_form.php file, the file will response back text to the xhttp object base on whether the condition is meeted or not.
If the condition in the php file "if($start_yet==yes)"  not triggered, then will not return back any text to xhttp object*/
function ajax_load_pollStarted(){
    // to make a http request, we need the instance of the object
    var xhttp = new XMLHttpRequest();
    // method, url, async
    xhttp.open("GET", "Utilities/display_form.php", true);
    xhttp.send();
    //only pass in the name of the callback function
    xhttp.onreadystatechange=statechange_pollStarted_handler;

    
}

function statechange_pollStarted_handler(){
    console.log(this.readyState) //open up inspect, to check the setInterval stop or not
    if(this.readyState==4 && this.status==200){
        if(this.responseText.includes("form")){
            document.getElementById("changeable").innerHTML = this.responseText;
            console.log(typeof timer);
            clearInterval(timer);

            const arr_not_started = document.getElementsByClassName("not_started_text")

            for(let item of arr_not_started){
                item.innerHTML = "";
            }
        }
        // alert(this.responseText);
    }

}



//
function ajax_check_pollEnded(){
    timer = setInterval(ajax_load_pollEnded, 1000);
    console.log(typeof timer)
}

function ajax_load_pollEnded(){
    // to make a http request, we need the instance of the object
    var xhttp = new XMLHttpRequest();
    // method, url, async
    xhttp.open("GET", "Utilities/check_poll_ended.php", true);
    xhttp.send();
    //only pass in the name of the callback function
    xhttp.onreadystatechange=statechange_pollEnded_handler;
}

function statechange_pollEnded_handler(){
    // console.log("poll end handler");
    console.log(this.readyState) //open up inspect, to check the setInterval stop or not
    // console.log(this.status);
    // location.href = "../prof_directPage/prof_result.php";
    if(this.readyState==4 && this.status==200){
            if(this.responseText.includes("Professor has ended the poll, now redirect you to see the results")){
                // alert(this.responseText);
                location.href = "prof_directPage/prof_result.php";
                clearInterval(timer);
            }
    }
        // alert(this.responseText);
}



//
function ajax_check_mode_rn(){
    timer = setInterval(ajax_load_mode, 1000);
    console.log(typeof timer)
}

function ajax_load_mode(){
    // to make a http request, we need the instance of the object
    var xhttp = new XMLHttpRequest();
    // method, url, async
    xhttp.open("GET", "Utilities/check_mode.php", true);
    xhttp.send();
    //only pass in the name of the callback function
    xhttp.onreadystatechange=statechange_mode_handler;
}

function statechange_mode_handler(){
    // console.log("poll end handler");
    console.log(this.readyState) //open up inspect, to check the setInterval stop or not
    // console.log(this.status);
    // location.href = "../prof_directPage/prof_result.php";
    if(this.readyState==4 && this.status==200){
            if(this.responseText.includes("Question Mode")){
                // alert(this.responseText);
                location.href = "form.php";
                clearInterval(timer);
            } else if(this.responseText.includes("Feedback Mode")){
                location.href = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/Student_ajax.php";
            }
    }
        // alert(this.responseText);
}