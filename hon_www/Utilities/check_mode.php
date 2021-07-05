<?php

require '../connect_db.php';
require 'db_operations.php';

$r = select_mode($conn, "Flags");
$val = NULL;

// echo var_dump($r);
echo var_dump($_SESSION["UBIT"]);

if($r!=NULL){
    $val = $r[0][3];
}

if($val=="question"){
    echo "Question Mode";
}elseif($val=="feedback"){
    echo "Feedback Mode";
}

