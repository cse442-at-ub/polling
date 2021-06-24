<?php

//display all result
function display_results($res){
    foreach($res as $elem){
        echo '<br>';
        // var_dump($elem);
        if ($elem[0]!="start_poll"){
            echo "<h3>" . $elem[0] . ": " . $elem[2] . "</h3>";
        }
    }
}


?>