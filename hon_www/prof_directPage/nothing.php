<?php

$db_host = "oceanus.cse.buffalo.edu:3306";
$db_name = "honching_db";
$db_user="honching";
$db_pass="50185646";

// $db_host = "localhost";
// $db_name = "June10th";
// $db_user="hon";
// $db_pass="123";

// this function return a connection to the DB
function connect_db($host, $user, $pass, $name){
    $connection = mysqli_connect($host, $user, $pass, $name);
    if (mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    echo "<h3>Student</h3>";
    echo "Connected successfully.";
    return $connection;
}

$conn = connect_db($db_host, $db_user, $db_pass, $db_name);

?>