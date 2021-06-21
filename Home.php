<?php
function connect_db() {
    $host = "oceanus.cse.buffalo.edu:3306";
    $user = "honching";
    $pass = "50185646";
    $name = "cse442_2021_summer_team_b_db";

    $connection = mysqli_connect($host, $user, $pass, $name);

    if (mysqli_connect_error()) {
        exit;
    }

    return $connection;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
?>
        <!DOCTYPE html>
        <html>
            <body>
                <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                    University at Buffalo Polling and Feedback System 
                </h1>

                <h2 style = "font-size: 17pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                    Enter your UBITName:
                </h2>

                <p style = "color: red; font-size: 9pt; font-family: Tahoma; font-weight: normal; text-align: center;">
                    Error: This is a required field.
                </p>

                <form action = "Home.php" method = "post">
                    <div style = "display: flex; justify-content: center; align-items: center;">
                        <input style = "font-family: Tahoma; font-weight: normal;" type = "text" name = "name"><br><br>
                    </div>
                    <div style = "display: flex; justify-content: center; align-items: center;">
                        <input type = "submit"> 
                    </div>           
                </form>
            </body>
        </html>
<?php
    }
    else {
        $conn = connect_db();

        $instructorResult = mysqli_query($conn, "SELECT UBIT FROM Instructors");

        $instructorExists = false;

        while ($i = mysqli_fetch_assoc($instructorResult)) {
            if ($i["UBIT"] == $_POST["name"]) {
                $instructorExists = true;
            }
        }

        $studentResult = mysqli_query($conn, "SELECT UBIT FROM Students");

        $studentExists = false;

        while ($j = mysqli_fetch_assoc($studentResult)) {
            if ($j["UBIT"] == $_POST["name"]) {
                $studentExists = true;
            }
        }

        if ($instructorExists) {
?>
            <!DOCTYPE html>
            <html>
                <body>
                    <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                        University at Buffalo Polling and Feedback System 
                    </h1>
        
                    <h2 style = "font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; right: 1%; top: 1%;">
                        Welcome, <?php echo $_POST["name"]; ?>!
                    </h2>

                    <div>
                        <p style = "color: #585858; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 3%; top: 8%;">
                            Current course: CSE 442
                        </p>
                    </div>

                    <form action = "Home.php" method = "post">
                        <div style = "position: fixed; left: 3%; top: 15%;">
                            <input type = "submit" value = "Change Course" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                        </div>
                    </form>

                    <p style = "font-size: 16pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 20%;">
                        Create a poll:
                    </p>

                    <form action = "Home.php" method = "post">
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "question" placeholder = "Question"><br><br><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "optionA" placeholder = "Option A"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "optionB" placeholder = "Option B"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "optionC" placeholder = "Option C"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "optionD" placeholder = "Option D"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 5px;">
                            <input type = "submit" value = "Launch Poll">
                        </div>
                    </form>

                    <form action = "Home.php" method = "post">
                        <div style = "position: fixed; right: 3%; top: 10.75%;">
                            <input type = "submit" value = "Start Feedback Mode" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                        </div>
                    </form>
                </body>
            </html>
<?php
        }
        elseif ($studentExists) {
?>
            <!DOCTYPE html>
            <html>
                <body>
                    <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                        University at Buffalo Polling and Feedback System 
                    </h1>
        
                    <h2 style = "font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; right: 1%; top: 1%;">
                        Welcome, <?php echo $_POST["name"]; ?>!
                    </h2>

                    <div>
                        <p style = "color: #585858; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 3%; top: 8%;">
                            Current course: CSE 442
                        </p>
                    </div>

                    <form action = "Home.php" method = "post">
                        <div style = "position: fixed; left: 3%; top: 15%;">
                            <input type = "submit" value = "Change Course" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                        </div>
                    </form>

                    <p style = "font-size: 14pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23%;">
                        No poll is currently open.
                    </p>

                    <!-- <p style = "font-size: 15pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 20%; padding: 5px;">
                        Which of the following is the best Dwight Schrute quote?
                    </p>

                    <form action = "Home.php" method = "post">
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 3px; font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                            <input type = "radio" id = "answerA" name = "poll" value = "answerA"><br>
                            <label for = "answerA"> "I am faster than 80% of all snakes" </label>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 3px; font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                            <input type = "radio" id = "answerB" name = "poll" value = "answerB"><br>
                            <label for = "answerB"> "You couldn't handle my undivided attention" </label>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 3px; font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                            <input type = "radio" id = "answerC" name = "poll" value = "answerC"><br>
                            <label for = "answerC"> "The eyes are the groin of the head" </label>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 3px; font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                            <input type = "radio" id = "answerD" name = "poll" value = "answerD"><br>
                            <label for = "answerD"> "Through concentration, I can raise and lower my cholesterol at will" </label>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 4px;">
                            <input type = "submit" value = "Submit Response">
                        </div>
                    </form> -->

                    <p style = "font-size: 12pt; font-family: Tahoma; font-weight: normal; position: fixed; right: 3%; top: 7.75%;">
                        Lecture feedback:
                    </p>

                    <form action = "Home.php" method = "post">
                        <div style = "position: fixed; right: 3.5%; top: 14%;">
                            <div style = "display: flex; justify-content: center; align-items: center; padding: 2.5px; font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                                <input type = "radio" id = "lost" name = "feedback" value = "lost"><br>
                                <label for = "lost"> I'm lost </label>
                            </div>
                            <div style = "display: flex; justify-content: center; align-items: center; padding: 2.5px; font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                                <input type = "radio" id = "right" name = "feedback" value = "right"><br>
                                <label for = "right"> Just right </label>
                            </div>
                            <div style = "display: flex; justify-content: center; align-items: center; padding: 2.5px; font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                                <input type = "radio" id = "easy" name = "feedback" value = "easy"><br>
                                <label for = "easy"> This is easy </label>
                            </div>
                            <div style = "display: flex; justify-content: center; align-items: center; padding: 4.5px;">
                                <input type = "submit" value = "Send Feedback" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                            </div>
                        </div>
                    </form>
                </body>
            </html>
<?php
        }
        else {
?>      
            <!DOCTYPE html>
            <html>
                <body>
                    <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                        University at Buffalo Polling and Feedback System 
                    </h1>

                    <h2 style = "font-size: 17pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                        Enter your UBITName:
                    </h2>

                    <p style = "color: red; font-size: 9pt; font-family: Tahoma; font-weight: normal; text-align: center;">
                        Error: Invalid entry.
                    </p>

                    <form action = "Home.php" method = "post">
                        <div style = "display: flex; justify-content: center; align-items: center;">
                            <input style = "font-family: Tahoma; font-weight: normal;" type = "text" name = "name"><br><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center;">
                            <input type = "submit"> 
                        </div>           
                    </form>
                </body>
            </html>
<?php   
        }
    }
}

mysqli_close($conn);
?>