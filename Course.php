<?php
session_start();

$name = htmlspecialchars($_POST["name"]);

$_SESSION["UBIT"] = $name;
$_SESSION["Instructor"] = false;
$_SESSION["Student"] = false;

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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_SESSION["UBIT"])) {
?>
        <!DOCTYPE html>
        <html>
            <body>
                <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                    University at Buffalo Polling and Feedback System 
                </h1>

                <h2 style = "font-size: 16pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                    Enter your UBITName:
                </h2>

                <p style = "color: red; font-size: 9pt; font-family: Tahoma; font-weight: normal; text-align: center;">
                    Error: This is a required field.
                </p>

                <form action = "Course.php" method = "post">
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
            if ($i["UBIT"] == $_SESSION["UBIT"]) {
                $instructorExists = true;
            }
        }

        $studentResult = mysqli_query($conn, "SELECT UBIT FROM Students");

        $studentExists = false;

        while ($j = mysqli_fetch_assoc($studentResult)) {
            if ($j["UBIT"] == $_SESSION["UBIT"]) {
                $studentExists = true;
            }
        }

        if (!$instructorExists && !$studentExists) {
?>
            <!DOCTYPE html>
            <html>
                <body>
                    <h1 style = "color: blue; font-size: 11pt; font-family: Tahoma; font-weight: normal; position: fixed; left: 1%; top: 1%;">
                        University at Buffalo Polling and Feedback System 
                    </h1>

                    <h2 style = "font-size: 16pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                        Enter your UBITName:
                    </h2>

                    <p style = "color: red; font-size: 9pt; font-family: Tahoma; font-weight: normal; text-align: center;">
                        Error: Invalid entry.
                    </p>

                    <form action = "Course.php" method = "post">
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
            $courses = [];

            if ($instructorExists) {
                $_SESSION["Instructor"] = true;

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
                $_SESSION["Student"] = true;

                $prepared = $conn -> prepare("SELECT * FROM Students WHERE UBIT = ?");

                $prepared -> bind_param("s", $_SESSION["UBIT"]);

                $result = $prepared -> execute();

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

                        <h2 style = "font-size: 16pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                            Select a course:
                        </h2>

                        <form action = "https://www-student.cse.buffalo.edu/CSE442-542/2021-Summer/cse-442b/hon_www/student_waitMode.php" method = "post">
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
        }
    }
}

$prepared -> close();
$conn -> close();
?>