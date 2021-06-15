<?php
$db_host = "oceanus.cse.buffalo.edu:3306";
$db_name = "cse442_2021_summer_team_b_db";
$db_user = "honching";
$db_pass = "50185646";

function connect_db($host, $user, $pass, $name) {
    $connection = mysqli_connect($host, $user, $pass, $name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();

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
        $conn = connect_db($db_host, $db_user, $db_pass, $db_name);

        $result = mysqli_query($conn, "SELECT UBIT FROM login");

        $exists = false;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["UBIT"] == $_POST["name"]) {
                $exists = true;
            }
        }

        if (!$exists) {
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
        else {
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
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "option1" placeholder = "Option 1"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "option2" placeholder = "Option 2"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "option3" placeholder = "Option 3"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 2px;">
                            <input style = "font-family: Tahoma; font-weight: normal; text-align: center;" type = "text" name = "option4" placeholder = "Option 4"><br>
                        </div>
                        <div style = "display: flex; justify-content: center; align-items: center; padding: 5px;">
                            <input type = "submit" value = "Launch Poll">
                        </div>
                    </form>

                    <form action = "Home.php" method = "post">
                        <div style = "position: fixed; right: 3%; top: 11%;">
                            <input type = "submit" value = "Start Feedback Mode" style = "font-size: 10pt; font-family: Tahoma; font-weight: normal;">
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