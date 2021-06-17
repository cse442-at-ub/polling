<?php

require '../connect_db.php';

$r = array();

echo "<h3>Now the poll ended, displaying the result</h3>";

// Once user get into this page, the start_poll result row will delete and re-insert
$sql_delete = "DELETE FROM comments WHERE title='start_poll'";

$query_res = mysqli_query($conn, $sql_delete);

if ($query_res ==false){
    echo mysqli_error($conn);
}else{
}

$sql_insert = "INSERT INTO comments(title, comment)
VALUES('" . "start_poll" . "','" . "no" . "')";
$query_insert_res = mysqli_query($conn, $sql_insert);
if($query_insert_res==false){
    echo mysqli_error($conn);
}else{
}


$sql_query = "SELECT * FROM comments";

$query_res = mysqli_query($conn, $sql_query);

if ($query_res ==false){
    echo mysqli_error($conn);
}else{
    $res = mysqli_fetch_all($query_res);  // return array from result set from the db
    $r = $res;
    // var_dump($r);
}


foreach($r as $elem){
    foreach($elem as $index => $val){
        if ($index==0 && $val!=""){
            echo "<br><h3>" . $val . ": ";
        } elseif ($index==1 && $val!=""){
            echo $val ."</h3>";
        }
        
    }
}

?>