<?php

// $db_host = "localhost";
// $db_name = "June10th";
// $db_user="hon";
// $db_pass="123";

$db_host = "oceanus.cse.buffalo.edu:3306";
$db_name = "honching_db";
$db_user="honching";
$db_pass="50185646";

// this function return a connection to the DB
function connect_db($host, $user, $pass, $name){
    $connection = mysqli_connect($host, $user, $pass, $name);
    if (mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    echo "<h3>Student</h3>";
    echo "Connected successfully.";
    return $connection;
}

$conn = connect_db($db_host, $db_user, $db_pass, $db_name);

$sql_query = "SELECT * FROM comments";

$query_res = mysqli_query($conn, $sql_query);

if ($query_res ==false){
    echo mysqli_error($conn);
}else{
    // $res = mysqli_fetch_all($query_res);  // return array from result set from the db
    // var_dump($res);
}

$sql_query_startpoll = "SELECT * FROM comments WHERE title='start_poll'";

$query_res = mysqli_query($conn, $sql_query_startpoll);

if ($query_res ==false){
    echo mysqli_error($conn);
}else{
    $res = mysqli_fetch_all($query_res);  // return array from result set from the db
    $r = $res;
}

$start_yet = NULL;

foreach($r as $elem){
    foreach($elem as $index => $val){
        if ($index==0 && $val!=""){
            // echo "<br><h3>" . $val . ": ";
        } elseif ($index==1 && $val!=""){
            if($val=="no" || $val="yes"){
                $start_yet = $val;
            }
            // echo $val ."</h3>";
        }
    }
}
?>

<?php if($start_yet=="no" || $start_yet==NULL):?>
<h3>The poll haven't start yet, click to refresh <a href="">refresh</a></h3>
<?php endif;?>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST" && $start_yet=="yes"){
    // var_dump($_POST);
    $sql_insert = "INSERT INTO comments(title, comment)
                    VALUES('" . $_POST['title'] . "','" . $_POST['content'] . "')";
    $query_insert_res = mysqli_query($conn, $sql_insert);
    if($query_insert_res==false){
        echo mysqli_error($conn);
    }else{
        // echo "<h1>Thank you for your poll response   </h1> <a href='see_result.php'>See result</a>";
        header("Location: thank_submission.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<!-- action="process_form.php" -->
    <h3>Have you had php experience before?</h3>
    <form method="post">
        <div>
            <label for="title">Name</label>
            <input type="text" name="title">
        </div>

        <div>
            <label for="content">comment</label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        
    
        <button>Send</button>
    </form>
</body>
</html>