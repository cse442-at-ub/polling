<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
    <title>Student Page</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/JavaScript'>

        function fetchdata() {
          $.ajax({
            url: 'testStudentAjaxEnd.php',
            type: 'post',
            success: function(data) {
              // Perform operation on return value
              //alert(data);
              document.getElementById('feedbackDisplay').innerHTML=data;
              document.getElementById("feedbackResult").value = data;
            },
            complete: function(data) {
              setTimeout(fetchdata, 1000);
            }
          });
        }
    
    
        $(document).ready(function() {
          setTimeout(fetchdata, 1000);
        }); 
        </script>
    <?php

    $db_host = "oceanus.cse.buffalo.edu:3306";
    $db_name = "cse442_2021_summer_team_b_db"; //honching_db yli55_db is not correct, here is our summer database name
    $db_user = "yli55"; //honching
    $db_pass = "50054188"; //50185646

    // this function return a connection to the DB
    function connect_db($host, $user, $pass, $name)
    {
        $connection = mysqli_connect($host, $user, $pass, $name);
        if (mysqli_connect_error()) {
            echo mysqli_connect_error();
            exit;
        } else {
            //echo "<h3>Student</h3>";
            //echo "Database Connected successfully. \r\n";
            echo "<br>";
        }
        // echo "<h3>Student</h3>";
        //echo "Connected successfully.";
        return $connection;
    }

    $conn = connect_db($db_host, $db_user, $db_pass, $db_name);


    //-- database above---------------------------------------------
    // define variables and set to empty values
    $nameErr = $UBITErr = $feadBackErr = "";
    $name = $UBIT = $feadBack = "";
    $flag = '';
    $update = '';
    $currentTime = '';
    // hardcoded
    $UBIT = 'yli88';
    //--------------------------



    //------pull the start info from DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // should be the response from ajax
        $flag = 'submitted';

        //echo nl2br(" 81 \r\n");

        if (empty($_POST["feadBack"])) {
            $feadBackErr = "feedback is required";
        } else {
            $feadBack = test_input($_POST["feadBack"]);
        }

        if (!empty($_POST["feadBack"])) {
            // echo nl2br(" 90 \r\n");
            // check if feedback mode is on, if it's on then insert feedback to DB !!??

            // echo nl2br("93  '" . $_POST['feedbackResult'] . "' \r\n");
            if ($_POST['feedbackResult'] == 'The feedback mode is On') { // then it will be allowed to insert
                // echo nl2br(" 95 \r\n");
                //}

                //-------------------
                echo "<br>";
                // echo $_POST['UBIT'];
                // echo $_POST['feadBack'];
                //echo $_POST['$currentTime'];
                //echo nl2br(" 144 Timestamp:  $currentTime \r\n");
                date_default_timezone_set('America/New_York');
                $currentTime = date("Y-m-d H:i:s");
                //echo ($currentTime);
                //$sql_insert = "INSERT INTO feedBackTable(InputTime,UBIT,Feedback) VALUES('" . $currentTime . "' ,'" . $_POST['UBIT'] . "','" . $_POST['feadBack'] . "')";
                $sql_insert = "INSERT INTO feedBackTable(InputTime,UBIT,Feedback) VALUES('" . $currentTime . "' ,'" . $UBIT . "','" . $_POST['feadBack'] . "')";

                //$sql_insert = "INSERT INTO feedBackTable(UBIT,Feedback) VALUES('yli55','I am lost')";// this one works //$currentTime

                $query_insert_res = mysqli_query($conn, $sql_insert);
                if ($query_insert_res == false) {
                    echo "123\r\n";
                    echo "<br>";
                    echo mysqli_error($conn);
                } else {
                    //echo "<h1>Thank you for your poll response   </h1> <a href='see_result.php'>See result</a>";
                    //header("Location: thank_submission.php");
                    //echo "<h2>Your feedback recorded  </h2>";
                }
                //-------------------------------
            } else {
                echo "<h2>Please submit your feedback when feedback mode is On </h2>";
            }
        } else { // user did not input feedback

        }
        // insert into database above--------------------
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <div id="feedbackDisplay"></div>
    <!-- <div id="feedbackDisplay">The feedback mode is On</div> -->
    <!-- <div id="feedbackDisplay"> The feedback mode is On</div> damn there's a space infront of 'The' cause wont be equal -->
    <h2>Feedback Form</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!--
    Name: <input type="text" name="name" value="<?php //echo $name; 
                                                ?>">
    <span class="error">* <?php //echo $nameErr; 
                            ?></span>
    <br><br>
    UBIT: <input type="text" name="UBIT" value="<?php echo $UBIT; ?>">
    <span class="error">* <?php //echo $UBITErr; 
                            ?></span>
    <br><br>
    <br><br>  -->
        Feedback:
        <br><br>
        How do you understand the content so far?
        <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "lost") echo "checked"; ?> value="I am lost">I am lost
        <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "Just right") echo "checked"; ?> value="Just right">Just right
        <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "easy") echo "checked"; ?> value="This is easy">This is easy

        <input type="hidden" name="feedbackResult" id="feedbackResult" />


        <span class="error">* <?php echo $feadBackErr; ?></span>

        <br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <script type="text/javascript">
        //document.getElementById("feedbackResult").value = 'The feedback mode is On'; //have to use value, I change to innerhtml!!!
        console.log("176");
        //console.log(document.getElementById("feedbackDisplay").innerHTML); // shows empty
        // document.getElementById("feedbackResult").value = document.getElementById("feedbackDisplay").innerHTML;
    </script>

    <?php
    if ($flag == 'submitted' and $_POST['feedbackResult'] == 'The feedback mode is On') {


        if (!empty($_POST["feadBack"])) {
            // if ($update == "update") {
            //   echo "<h2> Your resubmit got recorded, feedback got updated</h2>";
            // }
            //echo nl2br("87  '" . $_POST['UBIT'] . "' \r\n");
            echo "<h2>Your input recorded below:</h2>";
            // echo nl2br("Your UBIT:  '" . $UBIT . "' \r\n");
            //echo "<br>";
            echo nl2br("Your Feedback:  '" . $_POST['feadBack'] . "' \r\n");
            echo "<br>";
            echo nl2br("Timestamp:  $currentTime \r\n");
        } else {
            // should be only for on mode
            echo "<h2>You did not give your feedback, thus your feedback will not be considered</h2>";
        }
    }

    ?>

</body>

</html>
<?php

?>