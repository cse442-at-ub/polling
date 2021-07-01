<?php

require '../connect_db.php';
require '../Utilities/display.php';
require '../Utilities/db_operations.php';

// extract the last question from DB, make sure there is question within the DB
$question_tuple = select_lastQuestion($conn);
$theQuestion = $question_tuple[0][1];


$r = array();

echo "<h3>Now the poll ended, displaying the result</h3>";
echo "<p>" . $theQuestion ."</p>";


// Once user get into this page, the start_poll result row will delete and re-insert
clear_table($conn, "Flags");

insert_startPoll_no($conn, "Flags");

insert_profEndedthePoll($conn, "Flags");


$r = selectAll_exceptStartPoll($conn);

if(count($r)==0){
    header("Location: prof_noAnswer.php");
}

display_results($r);

?>