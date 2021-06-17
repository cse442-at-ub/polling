<!DOCTYPE HTML>
<html>

<head>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
</head>

<body>

  <?php
  /*
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
*/

  //-- database above---------------------------------------------
  // define variables and set to empty values
  $nameErr = $UBITErr = $feadBackErr = "";
  $name = $UBIT = $feadBack = "";
  $flag = '';
  $update = '';
  $currentTime = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = 'submitted';
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["UBIT"])) {
      $UBITErr = "UBIT is required";
    } else {
      $UBIT = test_input($_POST["UBIT"]);
      // check if UBIT is well-formed
      if (!preg_match("/^[a-zA-Z0-9]*$/", $UBIT)) {
        $UBITErr = "Invalid UBIT format";
      }
    }

    if (empty($_POST["feadBack"])) {
      $feadBackErr = "feedback is required";
    } else {
      $feadBack = test_input($_POST["feadBack"]);
    }

    if (!empty($_POST["feadBack"])) {

      //}
      // insert into database below--------------------
      // check if this record under the same UBIT already exist
      // $sql_query = "SELECT * FROM feedBackTable";

      //$query_res = mysqli_query($conn, $sql_query);
      /*
      if ($query_res == false) {
        echo "78\r\n";
        echo "<br>";
        echo mysqli_error($conn);
      }*/
      // connect successfully
      //else {
      //echo nl2br("83\r\n");
      //if (mysqli_num_rows($query_res) > 0) {
      //echo nl2br("86\r\n");
      // use WHERE clause to check whether ubit already exist, it the record found, then update; if not insert new record
      /*
        echo $_POST['UBIT'];
        echo $_POST['feadBack'];
        $sql_insert = "INSERT INTO feedBackTable(UBIT,Feedback) VALUES('" . $_POST['UBIT'] . "','" . $_POST['feadBack'] . "')";
        */
      //echo nl2br("87  '" . $_POST['UBIT'] . "' \r\n");
      /*  no update anymore
          $sql_where = "SELECT * FROM feedBackTable WHERE UBIT='" . $_POST['UBIT'] . "'"; //OMG these quote so annoying! Formating
          $query_where_res = mysqli_query($conn, $sql_where);
          if ($query_where_res == true) {
            // exist before, then update 
            //echo nl2br("99\r\n");
            if (mysqli_num_rows($query_where_res) > 0) {
              //echo nl2br("101\r\n");
              // update clause
              $update = "update";
              $sql_update = "UPDATE feedBackTable SET Feedback= '" . $_POST['feadBack'] . "'  WHERE UBIT= '" . $_POST['UBIT'] . "'";
              if (mysqli_query($conn, $sql_update)) {
                //echo nl2br("105");
                //echo "Records were updated successfully.";
              } else {
                echo "ERROR: Could not able to execute $sql_update. " . mysqli_error($link);
              }
            }
            // insert new 
            else {
              //echo nl2br("113\r\n");
              $sql_insert = "INSERT INTO feedBackTable(UBIT,Feedback) VALUES ('" . $_POST['UBIT'] . "','" . $_POST['feadBack'] . "')";
              if (mysqli_query($conn, $sql_insert)) {
                //echo nl2br("116\r\n");
                //echo "Records inserted successfully.";
                echo "<h2>Your feedback recorded  </h2>";
              } else {
                echo "ERROR: Could not able to execute $sql_insert. " . mysqli_error($conn);
              }
            }
          } else {
            echo nl2br("123\r\n");
            echo mysqli_error($conn);
          }

          */
      //}
      // first record insert directly
      //else {
      //echo "116\r\n";
      echo "<br>";
      // echo $_POST['UBIT'];
      // echo $_POST['feadBack'];
      //echo $_POST['$currentTime'];
      //echo nl2br(" 144 Timestamp:  $currentTime \r\n");
      date_default_timezone_set('America/New_York');
      $currentTime = date("Y-m-d H:i:s");
      //echo ($currentTime);
      $sql_insert = "INSERT INTO feedBackTable(InputTime,UBIT,Feedback) VALUES('" . $currentTime . "' ,'" . $_POST['UBIT'] . "','" . $_POST['feadBack'] . "')";
      //$sql_insert = "INSERT INTO feedBackTable(UBIT,Feedback) VALUES('yli55','I am lost')";// this one works //$currentTime

      $query_insert_res = mysqli_query($conn, $sql_insert);
      if ($query_insert_res == false) {
        echo "123\r\n";
        echo "<br>";
        echo mysqli_error($conn);
      } else {
        //echo "<h1>Thank you for your poll response   </h1> <a href='see_result.php'>See result</a>";
        //header("Location: thank_submission.php");
        echo "<h2>Your feedback recorded  </h2>";
      }
      //}
      //}
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

  <h2>Feedback Form</h2>
  <p><span class="error">* required field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>
    UBIT: <input type="text" name="UBIT" value="<?php echo $UBIT; ?>">
    <span class="error">* <?php echo $UBITErr; ?></span>
    <br><br>
    <br><br>
    Feedback:
    <br><br>
    How do you understand the content so far?
    <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "lost") echo "checked"; ?> value="I am lost">I am lost
    <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "Just right") echo "checked"; ?> value="Just right">Just right
    <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "easy") echo "checked"; ?> value="This is easy">This is easy
    <span class="error">* <?php echo $feadBackErr; ?></span>

    <br><br>
    <?php
    // date_default_timezone_set('America/New_York');
    // $currentTime = date("Y-m-d H:i:s");
    // echo ($currentTime);
    ?>
    <input type="submit" name="submit" value="Submit">
  </form>

  <?php
  if ($flag == 'submitted') {


    if (!empty($_POST["feadBack"])) {
      // if ($update == "update") {
      //   echo "<h2> Your resubmit got recorded, feedback got updated</h2>";
      // }
      //echo nl2br("87  '" . $_POST['UBIT'] . "' \r\n");
      echo "<h2>Your input recorded below:</h2>";
      echo nl2br("Your UBIT:  '" . $_POST['UBIT'] . "' \r\n");
      echo "<br>";
      echo nl2br("Your Feedback:  '" . $_POST['feadBack'] . "' \r\n");
      echo "<br>";
      echo nl2br("Timestamp:  $currentTime \r\n");
    } else {
      echo "<h2>You did not give your feedback, thus your feedback will not be considered</h2>";
    }
  }

  ?>

</body>

</html>
<?php
/*

date_sub($currentTime,date_interval_create_from_date_string("2 Minutes"));
echo date_format($currentTime,"Y/m/d H:i:s");


$userInputTime = $row->timeStamp; //from database

$subTwoMinTime = strtotime($currentTime);
$userInputTime = strtotime($userInputTime);

if (subTwoMinTime <= userInputTime) { // retrieve out for caculating average for the 2 mini }
echo nl2br("87  '" . $_POST['UBIT'] . "' \r\n");
*/
?>