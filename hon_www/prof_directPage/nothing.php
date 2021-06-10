<?php

$db_host = "oceanus.cse.buffalo.edu:3306";
$db_name = "honching_db";
$db_user="honching";
$db_pass="50185646";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()){
    echo mysqli_connect_error();
    exit;
}

echo "<h3>Student</h3>";
echo "Connected successfully.";

?>