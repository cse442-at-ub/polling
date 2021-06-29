<html>
<link rel="stylesheet" href="choose_poll_question.css">
<?php
    require 'connect_db.php';
    $sql = "SELECT * FROM QA";
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
            echo "select question #<input id='choice' type='submit' name='choice' class='button' value='" . $question_number ."' >";
            echo "</div>";
        }
      } else {
        echo "0 results";
      }

    // if(array_key_exists('choice', $_POST)) {
    //     $sql = "DELETE FROM QA WHERE ";

    //     if ($conn->query($sql) === TRUE) {
    //         echo "Record deleted successfully";
    //     } else {
    //         echo "Error deleting record: " . $conn->error;
    //             }
    // }
?>
</html>