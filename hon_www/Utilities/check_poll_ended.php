<?php

require '../connect_db.php';
require 'db_operations.php';

$r = select_prof_end_thePoll($conn, "Flags");

$val = check_poll_end_by_professor($r);

/* no - poll ended*/
if($val=="yes"){
    // header("Location: ../prof_directPage/prof_result.php");
    echo "Professor has ended the poll, now redirect you to see the results.";
}