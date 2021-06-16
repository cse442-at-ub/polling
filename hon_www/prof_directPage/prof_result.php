<?php

require '../connect_db.php';
require '../Utilities/display.php';
require '../Utilities/db_operations.php';

$r = array();

echo "<h3>Now the poll ended, displaying the result</h3>";
echo "<p>Have you had php experience before?</p>";

// Once user get into this page, the start_poll result row will delete and re-insert
delete_startpoll($conn);

insert_startPoll_no($conn);


$r = selectAll_exceptStartPoll($conn);

if(count($r)==0){
    header("Location: prof_noAnswer.php");
}

display_results($r);

?>