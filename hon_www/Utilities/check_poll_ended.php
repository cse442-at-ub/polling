<?php

require '../connect_db.php';
require 'db_operations.php';

$r = select_startpoll($conn, "Flags");

$val = check_poll_end($r);

/* no - poll ended*/
if($val=="no"){
    // header("Location: ../prof_directPage/prof_result.php");
    echo "Professor has ended the poll, now redirect you to see the results.";
}