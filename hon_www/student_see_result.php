<?php

require 'connect_db.php';
require 'Utilities/display.php';
require 'Utilities/db_operations.php';

// extract the last question from DB, make sure there is question within the DB
$question_tuple = select_lastQuestion($conn);
$theQuestion = $question_tuple[0][1];


$r = array();

echo "<h3>The current poll question ended, displaying the result</h3>";
echo "<p>" . $theQuestion ."</p>";

$r = selectAll_exceptStartPoll($conn);

// if there is no student reply to the current poll question, redirect
if(count($r)==0){
    header("Location: student_noAnswer.php");
}

display_results($r);

if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['backToFeedback']=="yes"){
    header("Location: https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/Student_ajax.php/");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>student side seeing results</title>
</head>
<body>
    <br>
    <br>
    <br>
    <form method="POST">
        <p>Click to redirect back in feedback mode</p>

        <button name="backToFeedback" type="submit" value="yes">Back to feedback</button><br><br>

        <!-- <label for="start_poll">You got php experiences before?</label> -->
    </form>
</body>
</html>