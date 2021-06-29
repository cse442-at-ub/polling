<?php

require '../connect_db.php';
require '../Utilities/db_operations.php';

// this also need to be talk to Elias, don't duplicate the row "node_rightNow"!
clear_table($conn, "Flags");

if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['questionMode']=="yes"){
    insert_questionModeANDredirect($conn, 'Flags');
} elseif($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['feedbackMode']=="yes"){
    insert_feedbackModeANDredirect($conn, 'Flags');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h3>Please select a mode for your students</h3>
    <!-- <button onclick="location.href='prof_decideStartPoll.php'">Question Mode</button> -->
    <!-- <button onclick="location.href='http://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/create_poll_question/create_poll_question.php'">Question Mode</button> -->
    <!-- <button onclick="location.href='form.php'">Feedback Mode</button> -->
    <form method="POST">
        <button name="questionMode" type="submit" value="yes">Question Mode</button><br><br>
    </form>

    <form method="POST">
        <button name="feedbackMode" type="submit" value="yes">Feedback Mode</button><br><br>
    </form>

</body>

<footer>
        <script type="text/javascript" src="Utilities/js_operations.js"></script>
        <script type="text/javascript" src="Utilities/ajax_handling.js"></script>
</footer>

</html>