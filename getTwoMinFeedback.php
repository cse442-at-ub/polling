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
$sql = "SELECT InputTime,UBIT, feedback FROM feedBackTable";
/*
$stmt = $mysqli->prepare($sql);
//$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($UBITname, $userFeedback);
$stmt->fetch();
$stmt->close();

echo "<table>";
echo "<tr>";
echo "<th>UBIT</th>";
echo "<td>" . $UBITname . "</td>";
echo "<th>Feedback</th>";
echo "<td>" . $userFeedback . "</td>";


echo "</tr>";
echo "</table>";
*/

$result = $mysqli->query($sql);

$lostPercentage = $rightPercentage = $easyPercentage = 0;
$count = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Timestamp: " . $row["InputTime"] . " --- UBIT: " . $row["UBIT"] . " --- feedback: " . $row["feedback"] . "<br>";
    }
} else {
    echo "0 results";
}
$mysqli->close();
