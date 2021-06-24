


<?php 

require '../connect_db.php';
require 'db_operations.php';

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

<!-- it won't return the html text unless this condition go through -->
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
    <button id="sup">Send</button>
</form>

<?php endif;?>