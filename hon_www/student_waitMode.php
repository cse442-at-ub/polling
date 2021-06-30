<?php
require 'Utilities/db_operations.php';

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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_SESSION["Course"])) {
        $conn = connect_db();

        $courses = [];

        $prepared = $conn -> prepare("SELECT * FROM Students WHERE UBIT = ?");

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

                <h2 style = "font-size: 16pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 23.5%;">
                    Select a course:
                </h2>

                <p style = "color: red; font-size: 9pt; font-family: Tahoma; font-weight: normal; text-align: center;">
                    Error: This is a required action.
                </p>

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
    else {
        $corrected = str_replace('-', ' ', $_SESSION["Course"]);
?>
        <!DOCTYPE html>
        <html lang = "en">
            <body onload = "ajax_check_mode_rn()">
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

                <p style = "font-size: 14.5pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 24.5%;">
                    This course is currently inactive.
                </p>
            </body>

            <footer>
                <script type = "text/javascript" src = "Utilities/js_operations.js"></script>
                <script type = "text/javascript" src = "Utilities/ajax_handling.js"></script>
            </footer>
        </html>
<?php
    }
}

$prepared -> close();
$conn -> close();
?>