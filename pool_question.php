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
            $sql = "SELECT * FROM QA ORDER BY ID DESC";
            $result = $conn->query($sql);
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
            <?php
                $alphabet = 'A';
                $choices_answer = $question["choices"];
                $choices_answer_array = explode(',',$choices_answer);
                foreach ($choices_answer_array as &$choice) {
                    echo "<li>" . $alphabet .".<input type='submit' name='choice' class='button' value='" . $choice ."' >" . "</li>";
                    $alphabet++; 
                }
            ?>

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