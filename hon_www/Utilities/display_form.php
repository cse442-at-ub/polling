<?php 

require '../connect_db.php';
require 'db_operations.php';

$startpoll_tuple = select_startpoll($conn, "Flags");

$start_yet = NULL;

// var_dump($startpoll_tuple);
if($startpoll_tuple!=NULL){
    $start_yet = $startpoll_tuple[0][2];
}

/* pull the last question out of DB*/
$question_tuple = select_lastQuestion($conn);
$theQuestion = $question_tuple[0][1];


// var_dump($question_tuple);
$the_choices_str = $question_tuple[0][3];

$the_choices_arr = explode(",", $the_choices_str);
// var_dump($the_choices_arr);


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
    <!-- <div id = "choices">
        <input type="radio" name="answer" value="Yes">
        <label for="answer">Yes</label>
    </div>

    <div>
        <input type="radio" name="answer" value="No">
        <label for="answer">No</label>
    </div> -->

    <?php 
        for($i=0; $i<count($the_choices_arr); $i++){
            echo "<input type='radio' name='answer' value=".$the_choices_arr[$i].">";
            echo "<label for='answer'>" . $the_choices_arr[$i] . "</label><br>";
            // var_dump($the_choices_arr[$i]);
        }
    ?>

    <button id="sup">Send</button>
</form>

<?php endif;?>