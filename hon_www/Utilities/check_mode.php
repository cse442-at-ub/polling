<?php

require '../connect_db.php';
require 'db_operations.php';

$r = select_mode($conn, "Flags");
$course_name = NULL;
$val = NULL;

// echo var_dump($r);
echo var_dump($_SESSION["UBIT"]);
// echo var_dump($_SESSION["Course"]);

if($r!=NULL){
    // $course_name = $r[0][1]
    $val = $r[0][3];
}

if($val=="question"){
    echo "Question Mode";
}elseif($val=="feedback"){
    echo "Feedback Mode";
}

