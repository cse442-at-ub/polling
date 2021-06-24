<?php

$table_name = "student_replies";

/* This function return a connection to the DB */
function connect_db($host, $user, $pass, $name){
    $connection = mysqli_connect($host, $user, $pass, $name);
    if (mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    // echo "<h3>Student</h3>";
    // echo "Connected successfully.";
    return $connection;
}

// $conn = connect_db("localhost", "hon", "123", "cse442localdb");

$conn = connect_db("oceanus.cse.buffalo.edu:3306", "honching", "50185646", "honching_db");

?>