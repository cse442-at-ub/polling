<?php
session_start();

$course = htmlspecialchars($_POST["course"]);

$_SESSION["Course"] = $course;

function connect_db() {
    $host = "oceanus.cse.buffalo.edu:3306";
    $user = "honching";
    $pass = "50185646";
    $db = "cse442_2021_summer_team_b_db";

    $connection = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_error()) {
        exit;
    }

    return $connection;
}
?>

<?php
$conn = connect_db();

function insert_questionMode($conn, $table_flags) {
    $sql_insert = "INSERT INTO " . $table_flags . "(flag_name, flag_val)
    VALUES('" . "mode_rightNow" . "','" . "question" . "')";

    $query_insert_res = mysqli_query($conn, $sql_insert);

    if ($query_insert_res == false) {
        echo mysqli_error($conn);
    }
    else {
    }
}

function insert_feedbackModeANDredirect($conn, $table_flags) {
    $sql_insert = "INSERT INTO " . $table_flags . "(flag_name, flag_val)
    VALUES('" . "mode_rightNow" . "','" . "feedback" . "')";

    $query_insert_res = mysqli_query($conn, $sql_insert);

    if ($query_insert_res == false) {
        echo mysqli_error($conn);
    }
    else {
        header("Location: https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/feedBack_AJAX.php");
    }
}

function clear_table($conn, $table) {
    $drop_id_column_query = "ALTER TABLE " . $table . " DROP id";

    mysqli_query($conn, $drop_id_column_query);

    $reinsert_id_query = "ALTER TABLE " . $table . " ADD id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id), AUTO_INCREMENT=1";
    mysqli_query($conn, $reinsert_id_query);

    $clearTable_query = "DELETE FROM " . $table;

    $clearTable_res = mysqli_query($conn, $clearTable_query);

    if ($clearTable_res == false) {
        echo mysqli_error($conn);
    }
    else {
    }
}

clear_table($conn, "Flags");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['questionMode'] == "yes") {
    insert_questionMode($conn, 'Flags');
    header("Location: Polling.php");
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['feedbackMode'] == "yes") {
    insert_feedbackModeANDredirect($conn, 'Flags');
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_SESSION["Course"])) {
        $courses = [];

        $prepared = $conn -> prepare("SELECT * FROM Instructors WHERE UBIT = ?");

        $prepared -> bind_param("s", $_SESSION["UBIT"]);

        $prepared -> execute();

        $result = $prepared -> get_result();

        $data = $result -> fetch_assoc();

        $courseCount = 1;

        for ($i = 2; $i < count($data); $i++) {
            $key = "Course " . $courseCount;

            array_push($courses, $data[$key]);

            $courseCount++;
        }
?>
        <!DOCTYPE html>
        <html>
            <body>
                <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                    University at Buffalo Polling and Feedback System 
                </h1>

                <form action = "" method = "post">
                    <div style = "position: fixed; left: 3%; top: 10.5%">
                        <input type = "submit" value = "Create Course" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form>

                <h2 style = "font-size: 16pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                    Select a course:
                </h2>

                <p style = "color: red; font-size: 9pt; font-family: Tahoma; font-weight: normal; text-align: center;">
                    Error: This is a required action.
                </p>

                <form action = "Home.php" method = "post">
                    <div style = "display: flex; justify-content: center; align-items: center;">
                        <select name = "course" id = "course">
<?php
                            $index = 0;

                            while ($courses[$index] != "") {
                                $corrected = str_replace(' ', '-', $courses[$index]);
?>
                                <option value = <?php echo htmlspecialchars($corrected); ?>> <?php echo htmlspecialchars($courses[$index]); ?> </option>
<?php
                                $index++;
                            }
?>
                        </select><br><br>
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
        $corrected = str_replace('-', ' ', $_SESSION["Course"]);
?>
        <!DOCTYPE html>
        <html>
            <body>
                <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                    University at Buffalo Polling and Feedback System 
                </h1>
        
                <h2 style = "font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; right: 1%; top: 1%;">
                    Welcome, <?php echo $_SESSION["UBIT"]; ?>!
                </h2>

                <p style = "color: #585858; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 3%; top: 8%;">
                    Current Course: <?php echo $corrected; ?>
                </p>

                <form action = "" method = "post">
                    <div style = "position: fixed; left: 3%; top: 14.5%">
                        <input type = "submit" value = "Change Course" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form>

                <form method = "post">
                    <div style = "display: flex; justify-content: center; align-items: center; padding: 7px; margin-top: 23.5%;">
                        <button name = "questionMode" type = "submit" value = "yes" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;"> Question Mode </button>
                    </div>
                </form>

                <form method = "post">
                    <div style = "display: flex; justify-content: center; align-items: center; padding: 7px;">
                        <button name = "feedbackMode" type = "submit" value = "yes" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;"> Start Feedback Mode </button>
                    </div>
                </form>

                <!-- <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/create_poll_question/create_poll_question.php">
                    <div style = "display: flex; justify-content: center; align-items: center; padding: 7px; margin-top: 23.5%;">
                        <input type = "submit" value = "Create Poll" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form>

                <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/feedBack_AJAX.php">
                    <div style = "display: flex; justify-content: center; align-items: center; padding: 7px;">
                        <input type = "submit" value = "Start Feedback Mode" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form> -->

            </body>
        </html>

        <!-- <!DOCTYPE html>
        <html>
            <body>
                <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                    University at Buffalo Polling and Feedback System 
                </h1>
        
                <h2 style = "font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; right: 1%; top: 1%;">
                    Welcome, !
                </h2>

                <p style = "color: #585858; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 3%; top: 8%;">
                    Current Course:  
                </p>

                <form action = "" method = "post">
                    <div style = "position: fixed; left: 3%; top: 14.5%;">
                        <input type = "submit" value = "Change Course" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form>

                <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/select_poll_question/pool_question.php">
                    <div style = "display: flex; justify-content: center; align-items: center; padding: 7px; margin-top: 23.5%;">
                        <input type = "submit" value = "Answer Poll" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form>

                <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/Student_ajax.php">
                    <div style = "display: flex; justify-content: center; align-items: center; padding: 7px;">
                        <input type = "submit" value = "Enter Feedback" style = "font-size: 11pt; font-family: Tahoma; font-weight: normal;">
                    </div>
                </form>
            </body>
        </html> -->
<?php
    }
}

$prepared -> close();
$conn -> close();
?>