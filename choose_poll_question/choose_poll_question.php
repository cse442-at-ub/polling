<html>
<link rel="stylesheet" href="choose_poll_question.css">
<?php
    require 'connect_db.php';
    $sql = "SELECT DISTINCT * FROM QA";
    $result = $conn->query($sql);
    $question_number = -1;
    $sql_data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $array = array($row['question'],$row['choices'],$row['answer']);
            array_push($sql_data,$array);
            echo "<div id='question_number" . strval($question_number) . "' class='c'>";
            $question_number = $question_number + 1;            ;
            echo "<div id='question" . strval($question_number) . "' class='a'>";
            $choices_answer = $row["choices"];
            $choices_answer_array = explode(',',$choices_answer);
            echo "<p>" .  $row['question']  . "</p>";
            echo "</div>";
            echo "<div id='choices" . strval($question_number) . "' class='b'>";
            foreach ($choices_answer_array as &$choice) {
                    echo "<li>" .  $choice  . "</li>";
                }
            echo "<p>Answer: " . $row['answer'] . "</p>";
            echo "</div>";
            echo "<form method='post'>";
            ?>
                <p>select question #<input onclick="myfunction()" id ='choice' type='submit' name ='choice' class='button' value='<?php echo $question_number ?>'>
                <script>
                function myfunction(){
                    window.open("http://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/hon_www/prof_directPage/prof_decideStartPoll.php");

                    

                }
                </script>
            <?php
            echo "</form>";
            echo "</div>";
        }
      } else {
        echo "0 results";
      }

    if(array_key_exists('choice', $_POST)) {
        $question = $sql_data[$_POST['choice']][0];
        $choice = $sql_data[$_POST['choice']][1];
        $answer = $sql_data[$_POST['choice']][2];
        // $sql = "DELETE FROM QA WHERE question='$question' and choices='$choice' and answer='$answer'";

        // if (!($conn->query($sql) === TRUE)) {
        //     echo "Error deleting record: " . $conn->error;
        //         }
        $sql = "INSERT INTO QA (question, answer, choices) 
        VALUES ('$question', '$answer', '$choice')";
        if (!($conn->query($sql) === TRUE)) {
            echo "Error insert record: " . $conn->error;
                }
        //header('location.href = "http://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/hon_www/prof_directPage/prof_decideStartPoll.php"');

    }
?>
</html>