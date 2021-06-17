<?php

require '../connect_db.php';
require '../Utilities/db_operations.php';

// clear the entire table when professor get to this page
clear_table($conn, $table_name);

insert_startPoll_fromPost($conn);

if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['start_poll']=="no"){
    echo "<h3>Okay then, then poll is not going to start until you say so</h3>";
} elseif($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['start_poll']=="yes"){
    //it's going to remove all existing tuples(except the flag 'start_poll') when prof start the poll question
    clear_table_exceptFlag($conn, $table_name);
    header("Location: prof_mid.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>start_poll</title>
</head>
<body>
    <form method="POST">
        <h3>Click to start the poll question.</h3>

        <button name="start_poll" type="submit" value="yes">Start</button><br><br>

        <label for="start_poll">You got php experiences before?</label>
    </form>
</body>
</html>