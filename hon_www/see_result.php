<?php

require 'connect_db.php';
require 'Utilities/db_operations.php';

$r = select_startpoll($conn);

/* to detect whether the poll has ended or not*/
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

<!-- will reload the page after 1500, since everytime page reload will again trigger this "onload", thus it's infinite loop until the above condition match and redirect to
prof_result.php -->
<body onload="reload_after(1000)">
<!-- when anchor put nothing, it means redirect to current page -->
<h3>The poll hasn't ended yet, <a href="">will automatically show you the result when the poll ended<a></h3>
    <!-- <h3>The poll hasn't end yet <a href="">click here to refresh</a></h3> -->
</body>


<footer>
    <script type="text/javascript" src="Utilities/js_operations.js"></script>
</footer>

</html>