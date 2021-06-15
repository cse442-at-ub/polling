<?php


// $db_host = "localhost";
// $db_name = "pool_question";
// $db_user="honching";
// $db_pass="50185646";
$db_host = "oceanus.cse.buffalo.edu:3306";
$db_name = "honching_db";
$db_user="honching";
$db_pass="50185646";

// this function return a connection to the DB
function connect_db($host, $user, $pass, $name){
    $connection = mysqli_connect($host, $user, $pass, $name);
    if (mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    echo "<h3>Student</h3>";
    echo "Connected successfully.";
    return $connection;
}

$conn = connect_db($db_host, $db_user, $db_pass, $db_name);

$sql = "CREATE TABLE IF NOT EXISTS QA (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(30) NOT NULL,
    answer VARCHAR(30) NOT NULL,
    choice_A VARCHAR(30) NOT NULL,
    choice_B VARCHAR(30) NOT NULL,
    choice_C VARCHAR(30) NOT NULL,
    choice_D VARCHAR(30) NOT NULL
    )";
if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
$sql = "SELECT * FROM QA";
$result = $conn->query($sql);
if($result->num_rows <= 0){
    $sql = "INSERT INTO QA (question, answer, choice_A, choice_B, choice_C, choice_D) 
    VALUES ('1+1=', 'B', '1', '2', '3', '4')";
    insert($conn,$sql);
    $sql = "INSERT INTO QA (question, answer, choice_A, choice_B, choice_C, choice_D) 
    VALUES ('A+B=', 'C', 'A', 'B', 'AB', 'BA')";
    insert($conn,$sql);
    $sql = "INSERT INTO QA (question, answer, choice_A, choice_B, choice_C, choice_D) 
    VALUES ('8845', 'A', 'M', 'H', 'N', 'U')";
    insert($conn,$sql);
    $sql = "INSERT INTO QA (question, answer, choice_A, choice_B, choice_C, choice_D) 
    VALUES ('color of air', 'C', 'Black', 'Pink', 'Green', 'Red')";
    insert($conn,$sql);

}
function insert($conn,$sql){
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
}
?>