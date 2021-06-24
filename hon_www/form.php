<?php

require 'connect_db.php';
require 'Utilities/db_operations.php';

$startpoll_tuple = select_startpoll($conn);

$start_yet = NULL;

// var_dump($startpoll_tuple);
if($startpoll_tuple!=NULL){
    $start_yet = $startpoll_tuple[0][2];
}

/* pull the last question out of DB*/
$question_tuple = select_lastQuestion($conn);
$theQuestion = $question_tuple[0][1];

// echo $_SERVER["REQUEST_METHOD"];
// var_dump($_POST);

?>

<?php if($start_yet=="no" || $start_yet==NULL):?>
    <div onload="reload_after(1000)"></div>
<!-- <h3>The poll hasn't start yet, click to refresh <a href="">refresh</a></h3> -->
<h3 class = "not_started_text">The poll hasn't start yet, <strong>will appear the question when the poll started</strong></h3>
<h3 class = "not_started_text">No question for you so far!</h3>
<?php endif;?>




<?php

insert_redirect_exceptFlag($conn, $start_yet);
// var_dump($_POST);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body onload="ajax_check_pollStarted()">

    <!-- <?php if($start_yet=="no" || $start_yet==NULL):?> -->
        <!-- <iframe onload="reload_after(1000)"></iframe> -->
    <!-- <?php endif;?> -->


    <div id="changeable">
        <!-- <button onclick="ajax_check_pollStarted()">Change content</button> -->
    </div>

</body>


<footer>
        <script type="text/javascript" src="Utilities/js_operations.js"></script>
        <script type="text/javascript" src="Utilities/ajax_handling.js"></script>
</footer>



</html>