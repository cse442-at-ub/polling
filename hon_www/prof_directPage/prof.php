<?php

require '../connect_db.php';

// Once user get into this page, the start_poll result row will delete and re-insert
$sql_query = "DELETE FROM comments WHERE title='start_poll'";

$query_res = mysqli_query($conn, $sql_query);

if ($query_res ==false){
    echo mysqli_error($conn);
}else{
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    // var_dump($_POST);
    $sql_insert = "INSERT INTO comments(title, comment)
                    VALUES('" . "start_poll" . "','" . $_POST['start_poll'] . "')";
    $query_insert_res = mysqli_query($conn, $sql_insert);
    if($query_insert_res==false){
        echo mysqli_error($conn);
    }else{
    }
}

if($_POST['start_poll']=="no"){
    echo "<h3>Okay then, then poll is not going to start until you say so</h3>";
} elseif($_POST['start_poll']=="yes"){
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
        <h3>To start the poll question or not</h3>
        <select name="start_poll" id="start_poll">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
        <button>Submit</button><br><br>

        <label for="start_poll">You got php experiences before?</label>
    </form>
</body>
</html>