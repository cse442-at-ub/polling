<?php

require '../connect_db.php';
require 'db_operations.php';

$r = select_stopViewing($conn, "Flags");
$val = NULL;

// echo var_dump($r);

if($r!=NULL){
    $val = $r[0][2];
}

if($val=="yes"){
    echo "stop viewing the results";
}