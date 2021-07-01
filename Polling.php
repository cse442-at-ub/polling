<?php
session_start();

function connect_db() {
    $host = "oceanus.cse.buffalo.edu:3306";
    $user = "honching";
    $pass = "50185646";
    $db = "cse442_2021_summer_team_b_db";

    $connection = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_error()) {
        exit;
    }

    return $connection;
}
?>

<!DOCTYPE html>
<html>
    <body>
        <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
            University at Buffalo Polling and Feedback System 
        </h1>

        <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/create_poll_question/create_poll_question.php">
            <div style = "display: flex; justify-content: center; align-items: center; padding: 7px; margin-top: 23.5%;">
                <input type = "submit" value = "Create Poll" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;">
            </div>
        </form>

        <!-- Action = is where the link to the poll selection page should go. -->
        <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/choose_poll_question/choose_poll_question.php">
            <div style = "display: flex; justify-content: center; align-items: center; padding: 7px;">
                <input type = "submit" value = "Select Poll" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;">
            </div>
        </form>
    </body>
</html>