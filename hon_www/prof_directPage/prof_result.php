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

if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["stop_results"]=="yes"){
    insert_stopViewingFlag($conn, "Flags");
    header("Location: https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/feedBack_AJAX.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Professor see poll results</title>
</head>
<body>

    <br><br><br>
    <p>Stop all student from viewing results and restrict them back into feedback mode.</p>
    <form method="POST">
        <button type="submit" name="stop_results" value="yes">Back to feedback</button>
    </form>
    
</body>
</html>

