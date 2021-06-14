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

                <h2 style = "font-size: 17pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 24%;">
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

                    <h2 style = "font-size: 17pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 24%;">
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
        
                    <h2 style = "font-size: 15pt; font-family: Tahoma; font-weight: normal; text-align: center; margin-top: 24%;">
                        Welcome, <?php echo $_POST["name"]; ?>!
                    </h2>
                </body>
            </html>
<?php
        }
    }
}

mysqli_close($conn);
?>