<!DOCTYPE HTML>
<html>

<head>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
  <title>Instructor Page</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
  $feadBackErr = "";
  $name = $UBIT = $feadBack = "";
  $flag = '';
  $update = '';
  $currentTime = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = 'submitted';


    if (empty($_POST["feadBack"])) {
      $feadBackErr = "Select Start Or End before you submit";
    } else {
      $feadBack = test_input($_POST["feadBack"]);
    }

    if (!empty($_POST["feadBack"])) {

      //echo "116\r\n";
      echo "<br>";
      //echo $_POST['$currentTime'];
      //echo nl2br(" 144 Timestamp:  $currentTime \r\n");
      date_default_timezone_set('America/New_York');
      $currentTime = date("Y-m-d H:i:s");
      //echo ($currentTime);
      //$sql_insert = "INSERT INTO feedBackTable(InputTime,UBIT,Feedback) VALUES('" . $currentTime . "' ,'" . $_POST['UBIT'] . "','" . $_POST['feadBack'] . "')";
      //$sql_insert = "INSERT INTO feedBackTable(UBIT,Feedback) VALUES('yli55','I am lost')";// this one works //$currentTime
      $sql_insert = "INSERT INTO feedBackTable(InputTime,UBIT,Feedback) VALUES('" . $currentTime . "' ,'instructor','" . $_POST['feadBack'] . "')";

      $query_insert_res = mysqli_query($conn, $sql_insert);
      if ($query_insert_res == false) {
        echo "123\r\n";
        echo "<br>";
        echo mysqli_error($conn);
      } else {
        //echo "<h1>Thank you for your poll response   </h1> <a href='see_result.php'>See result</a>";
        //header("Location: thank_submission.php");
        //echo "<h2>Your choice effected  </h2>";
        if ($_POST['feadBack'] == 'Start') {

          // keeps checking DB to display result now


        }
      }
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


  <p><span class="error">* required field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


    Do you want to Start Or End collecting student feedback of current teaching content?
    <br><br>
    <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "Start") echo "checked"; ?> value="Start"> Start collecting feedback
    <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack == "End") echo "checked"; ?> value="End">End collecting feedback
    <span class="error">* <?php echo $feadBackErr; ?></span>

    <br><br>

    <input type="submit" name="submit" id="begin" value="Submit" />

  </form>
  <div id="feedbackResult"> </div>
  <?php
  if ($flag == 'submitted') {


    if (!empty($_POST["feadBack"])) {

      echo "<br>";
      //echo nl2br("Timestamp:  $currentTime \r\n");
      echo "<br>";
      if ($_POST["feadBack"] == "Start") {
        echo "<h2>Feedback collecting is On now </h2>";

        echo "<script type='text/JavaScript'> 
        
        function fetchdata() {
          $.ajax({
            url: 'getTwoMinFeedback.php',
            type: 'post',
            success: function(data) {
              // Perform operation on return value
              //alert(data);
              document.getElementById('feedbackResult').innerHTML=data;
            },
            complete: function(data) {
              setTimeout(fetchdata, 2000);
            }
          });
        }
    
    
        $(document).ready(function() {
          setTimeout(fetchdata, 2000);
        }); 
        </script>
        ";
      }
      if ($_POST["feadBack"] == "End") {
        echo "<h2>Feedback mode Ends now </h2>";
        echo "<br>";
        echo "<h2>The class is not active </h2>";
      }
    } else {
      echo "<h2>You did not choose Start or End feedback mode</h2>";
    }
  } else {
    echo "<h2>The class is Not Active</h2>";
  }

  ?>

</body>
<script>
  /*
  function fetchdata() {
    $.ajax({
      url: 'getTwoMinFeedback.php',
      type: 'post',
      success: function(data) {
        // Perform operation on return value
        alert(data);
      },
      complete: function(data) {
        setTimeout(fetchdata, 5000);
      }
    });
  }

  $(document).ready(function() {
    setTimeout(fetchdata, 5000);
  });  */


  //<input type="submit" name="submit" value="Submit" onclick="setInterval('analyseData();', 10000);">
  /* var id = setInterval('analyseData();', 3000); // 10 second
   function analyseData() {
     const xhttp = new XMLHttpRequest();
     xhttp.onload = function() {
       document.getElementById("feedbackResult").innerHTML = this.responseText;
     }
     xhttp.open("GET", "getTwoMinFeedback.php");
     xhttp.send();
   }
  
   console.log("In AJAX!!");

   function stopFeedback() { // call this to stop your interval.
     clearInterval(id);
   }   */
  /*
    document.getElementById('begin').addEventListener('click', function() {
      console.log("in 182");
      setInterval(analyseData, 3000);
      //setTimeout(analyseData, 3000);
    });
    
      function analyseData() {
        console.log("187");
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("feedbackResult").innerHTML = this.responseText;
        }
        xhttp.open("GET", "getTwoMinFeedback.php");
        xhttp.send();
      }  */
  /*$(function() {

    $('#begin').click(function() {
      count = 0;
      wordsArray = ["Text 1", "Text 2", "Text 3", "Text 4", "Text 5", "Text 6"];
      setInterval(function() {
        count++;
        $(".first").fadeOut(400, function() {
          $(this).text(wordsArray[count % wordsArray.length]).fadeIn(400);
        });
      }, 5000);
    });
  }); */

  /*
    $('#begin').on('click', function(e) {
      //e.preventDefault();

      function fetchdata() {
        $.ajax({
          url: 'getTwoMinFeedback.php',
          type: 'post',
          success: function(data) {
            // Perform operation on return value
            alert(data);
          },
          complete: function(data) {
            setTimeout(fetchdata, 5000);
          }
        });
      }


      $(document).ready(function() {
        setTimeout(fetchdata, 5000);
      });

    }); */
</script>

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