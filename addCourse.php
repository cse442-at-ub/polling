<?php
// Load the database configuration file
//include_once 'dbConfig.php';
$dbHost     = "oceanus.cse.buffalo.edu:3306";
$dbUsername = "yli55";
$dbPassword = "50054188";
$dbName     = "cse442_2021_summer_team_b_db";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// Get status message
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if (!empty($statusMsg)) { ?>
    <div class="col-xs-12">
        <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
    </div>
<?php } ?>

<div class="row">
    <!-- Import link -->
    <!-- <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
    </div> -->
    <!-- CSV file upload form -->
    <!-- <div class="col-md-12" id="importFrm" style="display: none;"> -->
    <div class="col-md-12 head">
        <form action="compare.php" method="post" enctype="multipart/form-data">
            Course Title: <input type="text" name="course" value="<?php echo $course; ?>">
            <br><br>
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>


</div>

<!-- Show/hide CSV upload form -->
<script>
    // function formToggle(ID) {
    //     var element = document.getElementById(ID);
    //     if (element.style.display === "none") {
    //         element.style.display = "block";
    //     } else {
    //         element.style.display = "none";
    //     }
    // }
</script>