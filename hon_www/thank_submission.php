<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body onload = "js_countDown_redirect('see_result.php', 1000)">
    <h3>Thank you for your submission!</h3>
    <!-- <p>Click to see the result(if the result ended)<a href='see_result.php'>see result</a></p> -->
    <h4>redirecting you to see the result in <h3 id="count">5</h3> </h4>
</body>


<footer>

    <!-- <script type="text/javascript">
    
    function js_countDown_redirect(theUrl, time_ms){
        var seconds = 5;
        var counting = setInterval(function(){
            seconds -= time_ms/1000;
            document.getElementById("count").innerText = seconds;
            if (seconds<=0){
            location.href="see_result.php";
            }
        },
        time_ms
        )
    }
    
    </script> -->

    <script type="text/javascript" src="Utilities/js_operations.js"></script>

</footer>

</html>