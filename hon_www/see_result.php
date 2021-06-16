<?php

require 'connect_db.php';
require 'Utilities/db_operations.php';

$r = select_startpoll($conn);

foreach($r as $elem){
    foreach($elem as $index => $val){
        if ($index==0 && $val!=""){
            // echo "<br><h3>" . $val . ": ";
        } elseif ($index==1 && $val!=""){
            if($val=="no"){
                header("Location: prof_directPage/prof_result.php");
            }
            // echo $val ."</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<!-- when anchor put nothing, it means redirect to current page -->
    <h3>The poll hasn't end yet <a href="">click here to refresh</a></h3>
</body>
</html>