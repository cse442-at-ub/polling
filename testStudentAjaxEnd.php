<?php
//echo "In getTwoMin.php";
$mysqli = new mysqli("oceanus.cse.buffalo.edu:3306", "yli55", "50054188", "cse442_2021_summer_team_b_db");
if ($mysqli->connect_error) {
    exit('Could not connect');
} else {
    //echo "6 Connected successfully.";
}
//------------------------
//$db_host = "oceanus.cse.buffalo.edu:3306";
//$db_name = "cse442_2021_summer_team_b_db"; //honching_db yli55_db is not correct, here is our summer database name
//$db_user = "yli55"; //honching
//$db_pass = "50054188"; //50185646
// this function return a connection to the DB
//------------------------
//$sql = "SELECT UBIT, feedback FROM feedBackTable WHERE customerid = ?";
date_default_timezone_set('America/New_York');
$date = new DateTime('NOW');
$date->format("Y/m/d H:i:s");
//echo date_format($date, "Y/m/d H:i:s");
//echo "<br>";
//date_sub($date, date_interval_create_from_date_string("2 Minutes"));
//echo date_format($date, "Y/m/d H:i:s");
$datetoString = date_format($date, "Y/m/d H:i:s"); // already minus 2 min
//echo $datetoString;
//echo "<br>";

//$string = strtotime($datetoString); // use this unix time to compare with the DB
//print("Timestamp: ".$string); 
//$datetoString = '2021-06-23 01:39:01'; //1 people yli77
//$datetoString = '2021-06-23 01:38:05'; // 2 people
//$datetoString = '2021-06-22 02:07:53'; // 3 people
$sql = "SELECT InputTime,UBIT, feedback FROM feedBackTable ";

$result = $mysqli->query($sql);

$lostPercentage = $rightPercentage = $easyPercentage = 0;
$count = 0;
$arr = array();

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        //echo "Timestamp: " . $row["InputTime"] . " -------  UBIT: " . $row["UBIT"] . " ------  feedback: " . $row["feedback"] . "<br>";
        //echo "<br>";
        //$arr += [$row["UBIT"] => $row["feedback"]]; // if the key already exist, it won't push into the array

        // only insert the instructor feedback choice
        if ($row["feedback"] == "Start" || $row["feedback"] == "End") {
            $arr += [$row["UBIT"] => $row["feedback"]];
        }

        if (sizeof($arr) == 0) {
            //$arr += [$row["UBIT"] => $row["feedback"]];

        } else {
            foreach ($arr as $key => $value) {

                if ($key == $row["UBIT"]) {
                    $arr[$key] = $row["feedback"];
                    //echo "update instructor choice Start Or End ";
                    //echo "<br>";
                }
                //echo "UBIT: " . $key . "<br>";
                //echo "Previous Choose: " . $value . "<br>"; // here is the previous feedback
                //echo "<br>";
            }
        }


        //print_r($arr);
        //echo "<br>";
        //echo "<br>";
    }

    if (sizeof($arr) == 0) {

        echo "<h2>The class is Inactive</h2>";
        //echo "<br>";
    } else {
        foreach ($arr as $key => $value) { // should be just one pair in this arr
            //echo "UBIT: " . $key . "<br>";
            //echo "Choice: " . $value . "<br>"; // here is the previous feedback
            //echo "<br>";
            if ($value == "Start") {
                echo "The feedback mode is On";
                //echo "<br>";
            } else {
                echo "The class is Inactive";
                //echo "<br>";
            }
        }
    }
} else {
    echo "0 results";
}
$mysqli->close();
/*

date_default_timezone_set('America/New_York');
$date=new DateTime('NOW');
$date->format("Y/m/d H:i:s");
echo date_format($date,"Y/m/d H:i:s");
 echo "<br>";
date_sub($date,date_interval_create_from_date_string("2 Minutes"));
echo date_format($date,"Y/m/d H:i:s");
//--------------get current time minus 2 min use method above



$subTwoMinTime = strtotime($currentTime);
$userInputTime = strtotime($userInputTime);

if (subTwoMinTime <= userInputTime) { // retrieve out for caculating average for the 2 mini }
echo nl2br("87  '" . $_POST['UBIT'] . "' \r\n");
*/