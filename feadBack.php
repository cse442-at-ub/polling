<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $UBITErr = $feadBackErr = "";
$name = $UBIT = $feadBack = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["UBIT"])) {
    $UBITErr = "UBIT is required";
  } else {
    $UBIT = test_input($_POST["UBIT"]);
    // check if UBIT is well-formed
    if (!preg_match("/^[a-zA-Z0-9]*$/",$UBIT)) {
      $UBITErr = "Invalid UBIT format";
    }
  }

  if (empty($_POST["feadBack"])) {
    $feadBackErr = "feadback is required";
  } else {
    $feadBack = test_input($_POST["feadBack"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Fead Back Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  UBIT: <input type="text" name="UBIT" value="<?php echo $UBIT;?>">
  <span class="error">* <?php echo $UBITErr;?></span>
  <br><br>
  <br><br>
  Feed Back:
  <br><br>
          How do you understand the content so far?
  <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack=="lost") echo "checked";?> value="I'm lost">I'm lost
  <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack=="Just right") echo "checked";?> value="Just right">Just right
  <input type="radio" name="feadBack" <?php if (isset($feadBack) && $feadBack=="easy") echo "checked";?> value="This is easy">This is easy  
  <span class="error">* <?php echo $feadBackErr;?></span>
  
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $UBIT;
echo "<br>";
echo $feadBack;
?>

</body>
</html>