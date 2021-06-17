<?php

    require 'connect_db.php';
    function choice($answer) {
        echo "student choose $_POST[choice]\n";
        if($_POST["choice"] == $answer)
            echo "correct!";
        else
            echo "wrong!";
    }
    $question_limit = false;
    if (!mysqli_connect_error()){
        
            $question_number = rand(0,$result->num_rows-1);
            $question = $result->fetch_assoc();
            $answer = $question["answer"];
            
        
           
?>


<html>
<link rel="stylesheet" href="pool_question.css">
<body>

<form method="post">
<div class='a' id="poll_question_div">
    <div class='b' id = "question_div">
        <p id = "question"><h1><?php echo $question["question"]; ?></h1></p>
    </div>
    <div id = "answer_div">
        <ul style="list-style-type:none">
            <li><input type="submit" name="choice" class="button" value="A" />&nbsp<?php echo $question["choice_A"]; ?></li>
            <li><input type="submit" name="choice" class="button" value="B" />&nbsp<?php echo $question["choice_B"]; ?></li>
            <li><input type="submit" name="choice" class="button" value="C" />&nbsp<?php echo $question["choice_C"]; ?></li>
            <li><input type="submit" name="choice" class="button" value="D" />&nbsp<?php echo $question["choice_D"]; ?></li>
        </ul>
    </div>
</div>
</form>
<?php
        if(array_key_exists('choice', $_POST)) {
            choice($answer);
        }

        
    ?>
</body>
</html>
<?php
    }else{
        echo "connection error";
    }
?>