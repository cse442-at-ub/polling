<html>
<link rel="stylesheet" href="index.css">
<body>

<form method="post">
<div class='a' id="poll_question_div">
    <div class='b' id = "question_div">
        <p id = "question"><h1>what is 1 + 1 = ?</h1></p>
    </div>
    <div id = "answer_div">
        <ul style="list-style-type:none">
            <li><input type="submit" name="choice" class="button" value="A" />&nbsp1</li>
            <li><input type="submit" name="choice" class="button" value="B" />&nbsp2</li>
            <li><input type="submit" name="choice" class="button" value="C" />&nbsp3</li>
            <li><input type="submit" name="choice" class="button" value="D" />&nbsp4</li>
        </ul>
    </div>
</div>
</form>
<?php
        if(array_key_exists('choice', $_POST)) {
            choice();
        }
        function choice() {
            echo "student choose $_POST[choice]\n";
            if($_POST["choice"] == 'B')
                echo "correct!";
            else
                echo "wrong!";
        }
        
    ?>
</body>
</html>
