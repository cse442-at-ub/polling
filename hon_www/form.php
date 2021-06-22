<?php

require 'connect_db.php';
require 'Utilities/db_operations.php';

$startpoll_tuple = select_startpoll($conn);

$start_yet = NULL;

// var_dump($startpoll_tuple);
if($startpoll_tuple!=NULL){
    $start_yet = $startpoll_tuple[0][2];
}

/* pull the last question out of DB*/
$question_tuple = select_lastQuestion($conn);
$theQuestion = $question_tuple[0][1];

?>

<?php if($start_yet=="no" || $start_yet==NULL):?>
<h3>The poll hasn't start yet, click to refresh <a href="">refresh</a></h3>
<h3>No question for you so far!</h3>
<?php endif;?>




<?php

insert_redirect_exceptFlag($conn, $start_yet);
// var_dump($_POST);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<!-- action="process_form.php" -->
    <!-- <h3>Have you had php experience before?</h3> -->
    <?php if($start_yet=="yes"):?>

    <p>The poll question is going on right now!</p>

    <h3> <?php echo $theQuestion?></h3>

    <form method="post">
        <!-- <div>
            <label for="name">Your name: </label>
            <input type="text" name ="name"><br>
        </div> -->
        <div>
            <input type="radio" name="answer" value="Yes">
            <label for="answer">Yes</label>
        </div>

        <div>
            <input type="radio" name="answer" value="No">
            <label for="answer">No</label>
        </div>
        <button>Send</button>
    </form>

    <?php endif;?>



</body>


<footer>
        <script type="text/javavscript" src="Utilities/js_operations.js"></script>
</footer>


</html>