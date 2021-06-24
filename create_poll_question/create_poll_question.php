<html>
<body>
<link rel="stylesheet" href="create_poll_question.css">
<div id ="poll_question">

<form method="post">
<div id = "question_div" class ='a'>
    <label for="question">Enter your question:</label><br>
    <input type="text" id="question" name="question"><br>
    <input type="hidden" id='choices_number' name='choices_number' value=0><br>

</div>
<div id ="answer_choice_div" class ='b'>
    <button onclick="add_answer_choice()">Add Answers</button><br>

</div> 
<div id = "answer_div" class ='a'>
    <label for="answer">Enter correct answer</label><br>
    <input type="text" id="answer" name="answer"><br>
    <input  type="submit" value="Submit" >

</div>
</form>
</div>
</body>
<script>
var choice = 0
function add_answer_choice(){
    choice += 1
    var get_div = document.getElementById("answer_choice_div")
    var answer_choice = choice + '.' + "<input type='text' id = 'choice" + choice + "'" +" name = 'choice" + choice + "'" +"><br>"
    get_div.innerHTML += answer_choice
    var get_choices_div = document.getElementById("choices_number")
    get_choices_div.value = choice
}
function hidden(){
    
    var get_div = document.getElementById("poll_question")
    get_div = get_div.type = hidden;
}
</script>
</html>
<?php
require 'connect_db.php';
if(array_key_exists('question', $_POST)) {
    if(!error_check()){
        replace_escape();
        print_form();
        add_data($conn);
    }
}

function replace_escape(){

    for ($i = 1; $i <= $_POST['choices_number']; $i++) {
        $choice_num = $_POST["choice" . strval($i)];
        $choice_num = str_replace(">","&gt",str_replace("<","&lt",str_replace("&","&amp",$choice_num)));
     }
}
function error_check(){
    $correct_answer_match = false;
    $choices_number = $_POST['choices_number'];
    for($i = 1; $i <= $choices_number; $i++) {
        $choice_num_i = "choice" . strval($i);
        if($_POST[$choice_num_i] == ''){
            echo "answer should not be empty";
            return true;
        }
        if($_POST[$choice_num_i] == $_POST['answer'])
            $correct_answer_match = true;
        for ($j = $i+1; $j <= $choices_number; $j++) {
            $choice_num_j = "choice" . strval($j);
            if($_POST[$choice_num_i] == $_POST[$choice_num_j]){
                echo "repeated answers";
                return true;
            }
        }
     }
     if(!$correct_answer_match){
         echo "correct answer does not match any of the answer choice";
         return true;
     }
    return false;
}

function print_form() {
    ?>
    <div id ='print_question' class = 'a'>
        <?php echo "<h1> Question: $_POST[question]</h1>"; ?><br>
    </div>
    
    <div id = 'print_choices' class = 'b'>
        <?php 
        $alphabet = 'A';
        for ($i = 1; $i <= $_POST['choices_number']; $i++) {
             $choice_num = "choice" . strval($i);
            echo "<h2>$alphabet. $_POST[$choice_num]</h2><br>";
            $alphabet++;
          }
        ?>
    </div>
    <div id = 'print_answer' class="a">
    <?php echo "<h1> Answer: $_POST[answer]</h1>"; ?><br>
    </div>
    <?php
}
function add_data($conn){
   
    $answers = "";
    for ($i = 1; $i <= $_POST['choices_number']; $i++) {
        $choice_num = "choice" . strval($i);
        $answers = $answers . $_POST[$choice_num];
        if($i != $_POST['choices_number'])
        $answers = $answers . ",";
     }
     $stmt = $conn->prepare("INSERT INTO QA (question, answer, choices) 
     VALUES (?, ?, ?)");
     $stmt->bind_param("sss", $_POST['question'], $_POST['answer'], $answers);
     $stmt->execute();
}

?>