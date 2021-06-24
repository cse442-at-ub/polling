<?php


// $db_host = "localhost";
// $db_name = "pool_question";
// $db_user="honching";
// $db_pass="50185646";
$db_host = "oceanus.cse.buffalo.edu:3306";
$db_name = "honching_db";
$db_user="honching";
$db_pass="50185646";

// this function return a connection to the DB
function connect_db($host, $user, $pass, $name){
    $connection = mysqli_connect($host, $user, $pass, $name);
    if (mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    
    return $connection;
}

$conn = connect_db($db_host, $db_user, $db_pass, $db_name);

