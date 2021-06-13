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

$sql_query = "SELECT * FROM comments WHERE title='start_poll'";

$query_res = mysqli_query($conn, $sql_query);

$r = array();

if ($query_res ==false){
    echo mysqli_error($conn);
}else{
    $res = mysqli_fetch_all($query_res);  // return array from result set from the db
    $r = $res;
}

foreach($r as $elem){
    foreach($elem as $index => $val){
        if ($index==0 && $val!=""){
            // echo "<br><h3>" . $val . ": ";
        } elseif ($index==1 && $val!=""){
            if($val=="no"){
                header("Location: prof_directPage/prof_result.php");
            }
            // echo $val ."</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h3>The poll hasn't end yet <a href="">click here to refresh</a></h3>
</body>
</html>