<?php

/*it's going to select all rows/tuples of our table except the start_poll*/
function selectAll_exceptStartPoll($conn){
    $sql_query = "SELECT * FROM student_replies WHERE student_name<>'start_poll'";

    $query_res = mysqli_query($conn, $sql_query);

    if ($query_res ==false){
        echo mysqli_error($conn);
    }else{
        $res = mysqli_fetch_all($query_res);  // return array from result set from the db
        return $res;
    }
}

function select_startpoll($conn){
    $sql_query = "SELECT * FROM student_replies WHERE student_name='start_poll'";

    $query_res = mysqli_query($conn, $sql_query);

    if ($query_res ==false){
        echo mysqli_error($conn);
    }else{
        $res = mysqli_fetch_all($query_res);  // return array from result set from the db
        return $res;
    }
}

/*it's going to delete the tuples where title = start_poll (the flag)*/
function delete_startpoll($conn){
    $sql_query = "DELETE FROM student_replies WHERE student_name='start_poll'";
    $query_res = mysqli_query($conn, $sql_query);
    if ($query_res ==false){
        echo mysqli_error($conn);
    }else{
    }
}

/*the flag here is the tuple with 'start_poll' as title, which play role as a trigger/flag
Here we aren't insert the flag, we insert user input instead. Need to check if the
user name empty, if name empty, we won't insert, we send alert to tell user type in name 
instead.
We also check whether the poll question start or not.*/
function insert_redirect_exceptFlag($conn, $start_yet){
    /* don't delete, use for later*/
    // if($_SERVER["REQUEST_METHOD"]=="POST" && $start_yet=="yes" && $_POST['name']!='' && isset($_POST['answer'])){
    //     $sql_insert = "INSERT INTO student_replies(student_name, student_answer)
    //                     VALUES('" . $_POST['name'] . "','" . $_POST['answer'] . "')";
    //     $query_insert_res = mysqli_query($conn, $sql_insert);
    //     if($query_insert_res==false){
    //         echo mysqli_error($conn);
    //     }else{
    //         // echo "<h1>Thank you for your poll response   </h1> <a href='see_result.php'>See result</a>";
    //         header("Location: thank_submission.php");
    //     }
    // }elseif($_SERVER["REQUEST_METHOD"]=="POST" && $start_yet=="yes" && $_POST['name']==''){
    //     echo "<h3>You need to key in your name!</h3>";
    // }elseif($_SERVER["REQUEST_METHOD"]=="POST" && $start_yet=="yes" && !isset($_POST['answer'])){
    //     echo "<h3>You need to choose your Answer!</h3>";
    // }
    //
    if($_SERVER["REQUEST_METHOD"]=="POST" && $start_yet=="yes" && isset($_POST['answer'])){
        $sql_insert = "INSERT INTO student_replies(student_name, student_answer)
                        VALUES('" . $_POST['name'] . "','" . $_POST['answer'] . "')";
        $query_insert_res = mysqli_query($conn, $sql_insert);
        if($query_insert_res==false){
            echo mysqli_error($conn);
        }else{
            // echo "<h1>Thank you for your poll response   </h1> <a href='see_result.php'>See result</a>";
            header("Location: thank_submission.php");
        }
    }elseif($_SERVER["REQUEST_METHOD"]=="POST" && $start_yet=="yes" && !isset($_POST['answer'])){
        echo "<script type='text/javascript'>alert('You need to choose your Answer!')</script>";
    }
}

/*insert the start_poll and start_poll result(from post)*/
function insert_startPoll_fromPost($conn){
    // just detect the _server even if not within the same scripts, think of it pass in as "one";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // var_dump($_POST);
        $sql_insert = "INSERT INTO student_replies(student_name, student_answer)
                        VALUES('" . "start_poll" . "','" . $_POST['start_poll'] . "')";
        $query_insert_res = mysqli_query($conn, $sql_insert);
        if($query_insert_res==false){
            echo mysqli_error($conn);
        }else{
        }
    }
}

function insert_startPoll_no($conn){
    $sql_insert = "INSERT INTO student_replies(student_name, student_answer)
    VALUES('" . "start_poll" . "','" . "no" . "')";
    $query_insert_res = mysqli_query($conn, $sql_insert);
    if($query_insert_res==false){
        echo mysqli_error($conn);
    }else{
    }
}

function clear_table_exceptFlag($conn, $table){
    //it's going to remove all existing tuples(except the flag 'start_poll') when prof start the poll question
    $clearTable_query = "DELETE FROM " . $table . " WHERE student_name<>'start_poll'";
    // echo $clearTable_query;
    $clearTable_res = mysqli_query($conn, $clearTable_query);
    if ($clearTable_res ==false){
        echo mysqli_error($conn);
    }else{
    }
}

function clear_table($conn, $table){
    //it's going to remove all existing tuples(except the flag 'start_poll') when prof start the poll question
    $clearTable_query = "DELETE FROM " . $table;
    // echo $clearTable_query;
    $clearTable_res = mysqli_query($conn, $clearTable_query);
    if ($clearTable_res ==false){
        echo mysqli_error($conn);
    }else{
    }
}

function select_lastQuestion($conn){
    $sql_query = "SELECT * FROM prof_questions ORDER BY ID DESC LIMIT 1";

    $query_res = mysqli_query($conn, $sql_query);

    if ($query_res ==false){
        echo mysqli_error($conn);
    }else{
        $res = mysqli_fetch_all($query_res);  // return array from result set from the db
        return $res;
    }
}

/* no - poll ended, yes - poll not end*/
function check_poll_end($r){
    /* to detect whether the poll has ended or not*/
    foreach($r as $elem){
        foreach($elem as $index => $val){
            if ($index==0 && $val!=""){
                // echo "<br><h3>" . $val . ": ";
            } elseif ($index==2 && $val!=""){
                if($val=="no"){
                    return $val;
                    // header("Location: prof_directPage/prof_result.php");
                }
                // echo $val ."</h3>";
            }
        }
    }
    return "yes";
}


?>